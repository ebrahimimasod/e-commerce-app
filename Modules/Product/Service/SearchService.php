<?php

namespace Modules\Product\Service;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Service\CategoryService;
use Modules\Product\Entities\Product;
use Modules\Product\Transformers\ProductResourceCollection;
use Modules\Property\Entities\Property;

trait SearchService
{

    public static function getSearchResultSort()
    {
        return [
            [
                'id' => 1,
                'name' => 'پربازدید ترین',
                'value' => ['visitCount', 'desc'],
            ],
            [
                'id' => 2,
                'name' => 'پرفروش ترین',
                'value' => ['buyCount', 'desc'],
            ],
            [
                'id' => 3,
                'name' => 'محبوب ترین',
                'value' => ['likeCount', 'desc'],
            ],
            [
                'id' => 4,
                'name' => 'جدید ترین',
                'value' => ['updated_at', 'desc'],
            ],
            [
                'id' => 5,
                'name' => 'ارزان ترین',
                'value' => ['amount', 'asc'],
            ],
            [
                'id' => 6,
                'name' => 'گران ترین',
                'value' => ['amount', 'desc'],
            ],
        ];
    }


    /**
     * جستجو محصولات
     * @param Request $request
     * @param null $category
     * @return ResponseFactory|Response
     */
    public static function doSearch(Request $request, $category = null)
    {
        $searchResults = [
            'items' => [],
            'meta' => [
                'currentPage' => 1,
                'nextPage' => 2,
                'prevPage' => false,
                'total' => 0,
            ]
        ];
        $products = self::productSearching($request, $category);
        $products = new ProductResourceCollection($products->paginate(12));
        $productItems = ProductService::sortingProductsItems($products, self::getSortFilter($request), true);
        $searchResults['items'] = $productItems;
        $searchResults['meta']['currentPage'] = $products->currentPage();
        $searchResults['meta']['nextPage'] = self::getPageNumber($products->nextPageUrl());
        $searchResults['meta']['prevPage'] = self::getPageNumber($products->previousPageUrl());
        $searchResults['meta']['total'] = $products->lastPage();

        return httpResponse($searchResults);

    }

    /**
     * سرچ سریع
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public static function quickSearch(Request $request)
    {
        $request->request->add(['sortby' => '1']);
        $products = self::productSearching($request);
        $products = new ProductResourceCollection($products->paginate(5));
        $products = ProductService::sortingProductsItems($products, self::getSortFilter($request), true);
        $categories = new CategoryResourceCollection(self::searchForCategoriesByKeyword($request));
        return self::HttpResponse([
            'categories' => $categories,
            'products' => $products
        ]);
    }

    /**
     * گرفتن لیست محصولات از دسته بندی ها
     * @param null $category_slug
     * @return mixed
     */
    private static function getProductsFromCategory($category_slug = null)
    {
        $categoriesIds = [];
        if ($category_slug) {
            // get current category
            /** @var Category $category */
            $category = Category::where('slug', $category_slug)->with('sub_category')->firstOrFail();
            // check category depth
            switch ($category->depth) {
                // main category
                case 1:
                {
                    $childCategories = CategoryService::getCategories($category->id);
                    foreach ($childCategories as $childCategory) {
                        if (isset($childCategory['children']) && sizeof($childCategory['children']) > 0) {
                            foreach ($childCategory['children'] as $child) {
                                $categoriesIds[] = $child['id'];
                            }
                        }
                    }
                    break;
                }

                // category level 2
                case 2:
                {
                    if ($category->sub_category && $category->sub_category()->count()) {
                        foreach ($category->sub_category as $child) {
                            $categoriesIds[] = $child->id;
                        }
                    }
                    break;
                }

            }
        }
        return sizeof($categoriesIds) > 0 ? Product::whereIn('category_id', $categoriesIds) : Product::where('status', '!=', Product::DISABLE_STATUS);
    }

    /**
     * گرفتن رنج قیمت محصولات
     * @param $products
     * @return array
     */
    private static function getPriceRangeForSearch($products)
    {
        $priceRange = [
            'min' => '',
            'max' => '',
        ];

        if ($products) {
            $priceRange['min'] = $products->min('amount');
            $priceRange['max'] = $products->max('amount');
        }

        return $priceRange;
    }

    /**
     * گرفتن ویژگی های یک دسته بندی
     * @param $category
     * @return array
     */
    private static function getCategoryProperties($category)
    {
        $properties = [];
        $categoryProperties = $category->properties()->with('sub_properties')->get();

        if ($categoryProperties && $categoryProperties->count()) {
            $i = 0;
            foreach ($categoryProperties as $property) {
                if ($property->sub_properties && $property->sub_properties->count()) {
                    foreach ($property->sub_properties as $sub_property) {
                        if (($sub_property->data_type == Property::SELECT) && $sub_property->search_able) {
                            $properties[$i]['id'] = $sub_property->id;
                            $properties[$i]['name'] = $sub_property->name;
                            $properties[$i]['items'] = $sub_property->propertyItems;
                            $i++;
                        }

                    }
                }
            }
        }
        return $properties;
    }

    /**
     * گرفتن فیلتر مرتب سازی بر اساس
     * @param Request $request
     * @return mixed
     */
    private static function getSortFilter(Request $request)
    {
        $sortFilters = self::getSearchResultSort();
        if ($request->filled('sortby')) {
            $sortby = $request->sortby;
            foreach ($sortFilters as $sort) {
                if ($sort['id'] == $sortby) {
                    return $sort['value'];
                }
            }
        }
        return $sortFilters[0]['value'];
    }


    private static function getPageNumber($PageUrl)
    {
        return substr($PageUrl, (strpos($PageUrl, '=') + 1)) ? (int)substr($PageUrl, (strpos($PageUrl, '=') + 1)) : false;
    }


    private static function productSearching(Request $request, $category = null)
    {
        $products = self::getProductsFromCategory($category);

        $filters = self::getSearchFilters($request);

        if ($filters['q']) {
            $keyword = $filters['q'];

            /**
             * search product
             */
            $products->where(function ($products) use ($keyword) {
                $products->oRwhere('title_fa', 'LIKE', '%' . $keyword . '%');
                $products->oRwhere('title_en', 'LIKE', '%' . $keyword . '%');
            });


            /**
             * search brand
             */
            $brandsFound = Brand::where(function ($query) use ($keyword) {
                $query->where('name_fa', 'LIKE', '%' . $keyword . '%');
                $query->oRwhere('name_en', 'LIKE', '%' . $keyword . '%');
            })->pluck('id')->toArray();
            if ($brandsFound && sizeof($brandsFound) > 0) {
                $filters['brands'] = $brandsFound;
            }
        }

        if ($filters['brands']) {
            $brands = $filters['brands'];
            $products->whereHas('brand', function ($products) use ($brands) {
                $products->whereIn('brand_id', $brands);
            });
        }

        if ($filters['properties']) {
            $properties = [];
            foreach ($filters['properties'] as $property => $property_items) {
                $properties['properties'][] = $property;
                foreach ($property_items as $property_item) {
                    $properties['property_items'][] = $property_item;
                }
            }
            $products->whereHas('propertiesItems', function ($products) use ($properties) {
                $products->where('product_property_item.property_id', $properties['properties']);
                $products->whereIn('product_property_item.property_item_id', $properties['property_items']);
            });
        }

       /* if ($filters['price']) {
            if (isset($filters['price']['min'])) {
                $products->where('amount', '>=', $filters['price']['min']);
            }
            if (isset($filters['price']['max'])) {
                $products->where('amount', '<=', $filters['price']['max']);
            }
        }*/
       //TODO::search in variant table

        /*if ($filters['colors']) {
            $colors = $filters['colors'];
            $products->whereHas('colors', function ($products) use ($colors) {
                $products->whereIn('color_id', $colors);
            });
        }*/

      /*  if ($filters['sizes']) {
            $sizes = $filters['sizes'];
            $products->whereHas('sizes', function ($products) use ($sizes) {
                $products->whereIn('size_id', $sizes);
            });
        }*/

        /*if ($filters['has_selling_stock']) {
            $products->where('available', '>', 0);
        }*/

        return $products;
    }


    private static function searchForCategoriesByKeyword(Request $request)
    {
        $resultCategories = [];
        $filters = self::getSearchFilters($request);
        if ($filters['q']) {
            $keywords = explode(' ', $filters['q']);
            $categoriesGroup = [];
            $categoriesGroup[] = Category::where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->oRwhere(function ($query) use ($keyword) {
                        $query->where('name_fa', 'LIKE', '%' . $keyword . '%');
                        $query->oRwhere('name_en', 'LIKE', '%' . $keyword . '%');
                    });
                }
            })->get();

            foreach ($categoriesGroup as $categories) {
                foreach ($categories as $category) {
                    $resultCategories [] = $category;
                }
            }
        }

        return $resultCategories;
    }


    private static function getSearchFilters(Request $request)
    {
        $filters = [
            'q' => null,
            'brands' => null,
            'properties' => null,
            'price' => null,
            'colors' => null,
            'sizes' => null,
            'has_selling_stock' => null,
        ];

        if ($request->filled('q')) {
            $filters['q'] = str_replace('+', ' ', $request->q);
        }

        if ($request->filled('brands')) {
            $filters['brands'] = $request->brands;
        }

        if ($request->filled('properties')) {
            $filters['properties'] = $request->properties;
        }

        if ($request->filled('price')) {
            $filters['price'] = $request->price;
        }

        if ($request->filled('colors')) {
            $filters['colors'] = $request->colors;
        }

        if ($request->filled('sizes')) {
            $filters['sizes'] = $request->sizes;
        }

        if ($request->filled('has_selling_stock')) {
            $filters['has_selling_stock'] = $request->has_selling_stock;
        }


        return $filters;
    }


    private static function setMetaDataPage($category)
    {
        $pageTitle = 'جستو برای | فروشگاه ' . getSetting('name_fa');
        if ($category) {

            $pageTitle = 'جستو ' . $category->name_fa . ' | فروشگاه ' . getSetting('name_fa');
        }
        SEO::setTitle($pageTitle);
    }
}
