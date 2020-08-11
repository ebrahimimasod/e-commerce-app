<?php

namespace Modules\Property\Service;


use DB;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Property\Entities\Property;
use Modules\Property\Entities\PropertyItem;
use Modules\Property\Http\Request\CreatePropertyRequest;
use Modules\Property\Http\Request\UpdatePropertyRequest;
use Throwable;

class PropertyService
{

    public static function index(Request $request)
    {
        $parent_id = $request->parent_id;
        if ($request->filled('parent_id')) {
            $properties = Property::latest()->where('parent_id', $parent_id)->get();
        } else {
            $properties = Property::latest()->whereNull('parent_id')->get();
        }
        return $properties;
    }


    public static function store(CreatePropertyRequest $request)
    {
        $data = $request->validated();
        if (isset($data['parent_id'])) {
            $propertyData = [
                'name' => $data['name'],
                'data_type' => $data['data_type'],
                'parent_id' => $data['parent_id'],
                'search_able' => (boolean)isset($data['search_able']),
            ];
            try {
                DB::beginTransaction();
                $property = Property::create($propertyData);
                if ($data['data_type'] == Property::SELECT) {
                    $items = array_filter($data['items']);
                    foreach ($items as $item) {
                        PropertyItem::create([
                            'name' => $item,
                            'property_id' => $property->id
                        ]);
                    }
                }
                DB::commit();
            } catch (Exception $exception) {
                Log::error($exception);
                DB::rollBack();
            }
        } else {
            Property::create($data);
        }

        return httpResponse([
            'message' => 'با موفقیت ذخیره شد.'
        ]);
    }


    public static function update(UpdatePropertyRequest $request, $id)
    {
        $data = $request->validated();
        $property = Property::findOrFail($id);
        if (isset($data['parent_id'])) {
            $propertyData = [
                'name' => $data['name'],
                'data_type' => $data['data_type'],
                'parent_id' => $data['parent_id'],
                'search_able' => (boolean)isset($data['search_able']),
            ];
            try {
                DB::beginTransaction();
                $property->update($propertyData);
                if ($data['data_type'] == Property::SELECT) {
                    self::updatePropertiesItem($property, $data['items']);
                }
                DB::commit();
            } catch (Exception $exception) {
                Log::error($exception);
                DB::rollBack();
            }
        } else {
            $property->update($data);
        }
        return httpResponse([
            'message' => 'با موفقیت ویرایش شد.'
        ]);
    }


    public static function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return httpResponse('با موفقیت خذف شد.');
    }

    /**
     * اپدیت مقادیر پیش فرض ویژگی ها
     * @param Property $property
     * @param array $items
     */
    private static function updatePropertiesItem(Property $property, $items = [])
    {
        $items = array_filter($items);
        foreach ($items as $item) {
            PropertyItem::updateOrCreate([
                'name' => $item,
                'property_id' => $property->id,
            ]);
        }

        $idsForDelete = [];
        $oldItems = $property->propertyItems->toArray();
        foreach ($oldItems as $oldItem) {
            if (!in_array($oldItem['name'], $items)) {
                $idsForDelete[] = $oldItem['id'];
            }
        }
        if (sizeof($idsForDelete) > 0) {
            PropertyItem::destroy($idsForDelete);
        }
    }

    /**
     * گرفتن ویژگی های سطح دوم
     * @param $parent_id
     * @return ResponseFactory|Response
     */
    public static function getPropertyChild($parent_id)
    {
        $properties = PropertyItem::where('property_id', $parent_id)->get();
        return httpResponse($properties, 200);
    }

    /**
     * گرفتن ویژگی ها از دسته بندی ها
     * @param $category_id
     * @return ResponseFactory|Response
     */
    public static function getCategoryProperties($category_id)
    {
        $category = Category::where('id',$category_id)->firstOrFail();
        $properties = $category->properties()->with(['sub_properties'])->get();
        return httpResponse($properties, 200);
    }

    /**
     * ذخیره ویژگی ها در دسته بندی
     * @param Request $request
     * @param Category $category
     */
    public static function saveCategoryProperties(Request $request, Category $category)
    {
        if ($request->filled('properties') && sizeof($request->properties) > 0) {
            foreach ($request->properties as $property) {
                $category->properties()->attach($property);
            }
        }
    }

    /**
     * اپدیت ویژگی ها  در دسته بندی
     * @param Request $request
     * @param Category $category
     */
    public static function updateCategoryProperties(Request $request, Category $category)
    {
        if ($request->filled('properties') && sizeof($request->properties) > 0) {
            $category->properties()->sync($request->properties);
        } else {
            $category->properties()->delete();
        }
    }


    /**
     * منتصب کردن ویژگی ها به محصولات
     * @param Request $request
     * @param Product $product
     * @throws Exception
     * @throws Throwable
     */
    public static function attachPropertyProduct(Request $request, Product $product)
    {
        $categoryProperties = $product->category->properties()->with('sub_properties')->get()->toArray();
        foreach ($categoryProperties as $propertyGroup) {
            foreach ($propertyGroup['sub_properties'] as $key => $property) {
                try {
                    DB::beginTransaction();
                    $value = $property['data_type'] == Property::TEXT ? (string)self::getPropertyFromRequest($request, $property['id']) : null;
                    $product->properties()->attach($property['id'], ['value' => $value]);
                    if ($property['data_type']==Property::SELECT && self::getPropertyFromRequest($request, $property['id'])) {
                        $items = array_filter((array)self::getPropertyFromRequest($request, $property['id']));
                        foreach ($items as $item) {
                            $product->propertiesItems()->attach($item, ['property_id' => $property['id']]);
                        }
                    }
                    DB::commit();
                } catch (\Throwable $exception) {
                    Log::error($exception);
                    DB::rollBack();
                }
            }
        }
    }

    /**
     * اپدیت ویژگی های محصول
     * @param Request $request
     * @param Product $product
     * @throws Exception
     * @throws Throwable
     */
    public static function updateProductProperties(Request $request, Product $product)
    {
        $product->properties()->detach();
        $product->propertiesItems()->detach();
        $categoryProperties = $product->category->properties()->with('sub_properties')->get()->toArray();
        foreach ($categoryProperties as $propertyGroup) {
            foreach ($propertyGroup['sub_properties'] as $key => $property) {
                try {
                    DB::beginTransaction();
                    $value =$property['data_type']==Property::TEXT ?(string)self::getPropertyFromRequest($request, $property['id']):null;
                    $product->properties()->attach($property['id'], ['value' => $value]);
                    if ($property['data_type']==Property::SELECT && self::getPropertyFromRequest($request, $property['id'])) {
                        $items = array_filter((array)self::getPropertyFromRequest($request, $property['id']));
                        foreach ($items as $item) {
                            $product->propertiesItems()->attach($item, ['property_id' => $property['id']]);
                        }
                    }
                    DB::commit();
                } catch (\Throwable $exception) {
                    Log::error($exception);
                    DB::rollBack();
                }
            }
        }
    }

    /**
     * گرفتن ویژگی ها محصول
     * @param Product $product
     * @return array
     */
    public static function getProductProperties(Product $product)
    {
        $properties = [];
        $i = 0;
        foreach (Property::with('sub_properties')->get()->toArray() as $key => $property) {
            if (!$property['parent_id']) {
                $properties[$i]['groupName'] = $property['name'];
                $properties[$i]['id'] = $property['id'];
                $j = 0;
                foreach ($property['sub_properties'] as $key2 => $sub_property) {
                    $properties[$i]['properties'][$j]['id'] = $sub_property['id'];
                    $properties[$i]['properties'][$j]['name'] = $sub_property['name'];
                    if ($key2 == 1 && $key != 0) {
                        $properties[$i]['properties'][$j]['primary'] = true;
                    } else {
                        $properties[$i]['properties'][$j]['primary'] = false;
                    }
                    if (self::checkEmptyPropertyValue(self::getPropertyValues($product, $sub_property))) {
                        $properties[$i]['properties'][$j]['value'] = self::getPropertyValues($product, $sub_property);
                        $j++;
                    } else {
                        unset($properties[$i]['properties'][$j]);
                    }
                }
                $i++;
            }
        }

        foreach ($properties as $key => $property) {
            if (sizeof($property['properties']) == 0) {
                unset($properties[$key]);
            }
        }

        return $properties;
    }

    /**
     * گرفتن ویزگی های اصلی محصول
     * @param $properties
     * @return array
     */
    public static function getProductPrimaryProperties($properties)
    {
        $primaryProperties = [];
        foreach ($properties as $propertyGroup) {
            foreach ($propertyGroup['properties'] as $property) {
                if ($property['primary']) {
                    $primaryProperties[] = $property;
                }
            }
        }
        return $primaryProperties;
    }

    /**
     * گرفتن مقادیر ویژگی ها
     * @param Product $product
     * @param $sub_property
     * @return array|bool
     */
    public static function getPropertyValues(Product $product, $sub_property)
    {
        $property = $product->properties()->where('id', $sub_property['id'])->first();
        if ($property) {
            switch ($property->data_type) {
                case Property::TEXT:
                {
                    $value = $property->pivot->value;
                    return explode("\n", str_replace("\r", "", $value));
                    break;
                }

                case Property::SELECT:
                {
                    $items = $product->propertiesItems()->where('product_property_item.property_id', $sub_property['id'])->get();
                    if ($items && $items->count()) {
                        return $values = $items->pluck('name')->toArray();
                    }
                    return false;
                    break;
                }
            }
        }
    }

    private static function getPropertyFromRequest(Request $request, $id)
    {
        $properties = $request->properties;
        foreach ($properties as $index => $property) {
            if ($property['id'] == $id) {
                return $property['value'];
            }
        }
        return null;
    }

    private static function checkEmptyPropertyValue($value)
    {
        if (is_array($value)) {
            if (sizeof($value) == 0 || $value[0] == '') {
                return false;
            }
        }
        return (boolean)$value;

    }



}
