<?php

namespace Modules\Product\Service;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Log;
use Modules\Media\Entities\Media;
use Modules\Media\Service\MediaService;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Request\CreateProductRequest;
use Modules\Product\Http\Request\UpdateProductRequest;
use Modules\Property\Entities\Property;
use Modules\Property\Service\PropertyService;
use Modules\Seller\Entities\Seller;
use Throwable;

class ProductService
{
    use SearchService;

    public static function index()
    {
        $products = Product::latest()->paginate(20);
        return httpResponse($products);
    }

    public static function store(CreateProductRequest $request, $sellerProduct = false)
    {
        $productNumber = strtolower(getAppPrefix()) . 'p-' . numberRandom(5);
        $data = $request->validated();
        $data['number'] = $productNumber;
        try {
            DB::beginTransaction();
            $product = Product::create($data);
            PropertyService::attachPropertyProduct($request, $product);
            self::saveProductDescription($request, $product);
            MediaService::create($request->images, $product);
            MediaService::create($request->videos, $product, Media::VIDEO);
            if ($sellerProduct) self::attachProductToSellers($product);
            DB::commit();
        } catch (Throwable $exception) {
            Log::error($exception);
            DB::rollBack();
        }

        return httpResponse('با موفقیت ذخیره شد.', 200);
    }

    public static function edit($id, $sellerProduct = false)
    {
        if ($sellerProduct) {
            /** @var Seller $seller */
            $seller = sellerAuth();
            if ($seller) {
                $product = $seller->products()->where('product_id', $id)->with(['medias', 'descriptions', 'properties'])->firstOrFail();
            } else {
                $product = Product::where('id', $id)->with(['medias', 'descriptions', 'properties'])->firstOrFail();
            }
        } else {
            $product = Product::where('id', $id)->with(['medias', 'descriptions', 'properties'])->firstOrFail();
        }

        $properties = [];
        foreach ($product->properties as $index => $property) {
            $properties[$index]['id'] = $property->id;
            $properties[$index]['value'] = self::getProductPropertyForEdit($product, $property);
        }
        return httpResponse([
            'product' => $product,
            'properties' => $properties,
        ]);
    }

    public static function update(UpdateProductRequest $request, $id, $sellerProduct = false)
    {
        $data = $request->validated();
        if ($sellerProduct) {
            /** @var Seller $seller */
            $seller = sellerAuth();
            if ($seller) {
                $product = $seller->products()->where('product_id',$id)->firstOrFail();
            }else{
                $product = Product::findOrFail($id);
            }
        } else {
            $product = Product::findOrFail($id);
        }

        try {
            DB::beginTransaction();
            $product->update($data);
            PropertyService::updateProductProperties($request, $product);
            self::updateProductDescription($request, $product);
            MediaService::create($request->input('images',[]), $product);
            MediaService::create($request->input('videos',[]), $product, Media::VIDEO);
            if ($sellerProduct) self::attachProductToSellers($product, true);
            DB::commit();
        } catch (Throwable $exception) {
            Log::error($exception);
            DB::rollBack();
        }
        return httpResponse('با موفقیت ویرایش شد.', 200);
    }

    public static function destroy($id, $force = false)
    {
        $product = Product::withTrashed()->findOrFail($id);
        /** @var Product $product */
        if ($force) {
            $product->forceDelete();
        } else {
            $product->delete();
        }
        return httpResponse('با موفقیت حدف شد.');
    }

    public static function show($slug)
    {
        $product = Product::where('slug', $slug)->with(['images', 'properties'])->firstOrFail();
        $properties = PropertyService::getProductProperties($product);
        $primaryProperties = PropertyService::getProductPrimaryProperties($properties);
        $similarProducts = self::getSimilarProducts($product);
        $variantId = self::getFirstProductVariantsId($product);
        $rates = $product->category->rates;
        $images = MediaService::images($product);
        $videos = MediaService::videos($product);
        try {
            VisitService::create($product);
            HistoryService::create($product);
            self::setMetaDataPage($product);
        } catch (Exception $exception) {
            Log::error($exception);
        }

        return view('pages.product.show.index', compact(
            'product',
            'properties',
            'primaryProperties',
            'similarProducts',
            'variantId',
            'rates',
            'images',
            'videos'
        ));
    }

    /**
     * ذخیره توضیحات محصول
     * @param Request $request
     * @param Product $product
     */
    private static function saveProductDescription(Request $request, Product $product)
    {
        if ($request->filled('description') && sizeof($request->description) > 0) {
            foreach ($request->description as $description) {
                if ($description['title'] && $description['body']) {
                    $product->descriptions()->create($description);
                }
            }
        }
    }

    /**
     * گرفتن ویژگی های محصول برای ویرایش
     * @param Product $product
     * @param $property
     * @return array|null
     */
    private static function getProductPropertyForEdit(Product $product, $property)
    {
        $value = null;
        if ($property) {
            switch ($property->data_type) {
                case Property::TEXT:
                {
                    $value = $property->pivot->value;
                    break;
                }

                case Property::SELECT:
                {
                    $value = [];
                    $items = $product->propertiesItems()->where('product_property_item.property_id', $property->id)->get();
                    if ($items && $items->count()) {
                        foreach ($items as $index => $item) {
                            $value[$index]['id'] = $item->id;
                            $value[$index]['name'] = $item->name;
                        }
                    }
                    break;
                }
            }
        }
        return $value;
    }

    /**
     * اپدیت توضیحات محصول
     * @param Request $request
     * @param Product $product
     */
    private static function updateProductDescription(Request $request, Product $product)
    {
        $product->descriptions()->delete();

        if ($request->filled('description') && sizeof($request->description) > 0) {
            foreach ($request->description as $description) {
                if ($description['title'] && $description['body']) {
                    $product->descriptions()->create($description);
                }
            }
        }
    }

    /**
     * مرتب سازی لیست محصولات
     * @param Collection $products
     * @param array $sort
     * @param bool $array
     * @return mixed
     */
    public static function sortingProductsItems($products, $sort = ['updated_at', 'desc'], $array = false)
    {
        $sortName = $sort[0];
        $sortDirection = $sort[1] == 'desc' ? true : false;
        $products = $products->sortBy(function ($query) use ($sortName) {
            if ($sortName == 'updated_at' || $sortName == 'created_at') {
                return strtotime($query->$sortName);
            } else {
                return $query->$sortName;
            }
        }, 1, $sortDirection);

        $products = $array ? $products->values()->all() : $products->values();

        return $products;
    }

    private static function attachProductToSellers(Product $product, $update = false)
    {
        /** @var Seller $seller */
        $seller = sellerAuth();
        if ($seller) {
            if ($update) {
                $seller->products()->sync($product->id);
            } else {
                $seller->products()->attach($product->id);
            }
        }
    }


}
