<?php

namespace Modules\Category\Service;


use DB;
use Exception;
use Illuminate\Http\Request;
use Log;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Request\CreateCategoryRequest;
use Modules\Category\Http\Request\UpdateCategoryRequest;
use Throwable;

class CategoryService
{

    public static function index(Request $request)
    {
        $parent_id = $request->parent_id;
        $pageTitle = 'لیست دسته بندی ها';
        $categories = Category::latest()->where('parent_id', $parent_id)->with('sub_category')->get();
        if ($request->filled('parent_id')) {
            $parentName = Category::where('id', $parent_id)->first();
            $pageTitle = $parentName ? $pageTitle . ' - ' . $parentName->name_fa : $pageTitle;
        } else {
            $pageTitle = $pageTitle . ' - دسته های اصلی';
        }
        return httpResponse([
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }

    public static function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $parent_id = $data['parent_id'];
        $data['depth'] = 1;
        $parentCategory = Category::find($parent_id);
        $data['main_category_id'] = self::getMainCategoryId($parentCategory);
        if ($parentCategory) {
            $data['depth'] = $parentCategory->depth + 1;
            try {
                DB::beginTransaction();
                $category = Category::create($data);
                self::attachVariantToCategory($category, $data['variants']);
                self::attachCategoryProperties($request, $category);
                self::attachCategoryBrands($request, $category);
                DB::commit();
            } catch (Throwable $exception) {
                Log::error($exception);
                DB::rollBack();
            }
        } else {
            Category::create($data);
        }
        return httpResponse([
            'message' => 'با موفقیت ذخیره شد.',
            'parent_id' => $parent_id
        ], 200);
    }

    public static function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();
        $parent_id = $data['parent_id'];
        $data['depth'] = 1;
        $parentCategory = Category::find($parent_id);
        $data['main_category_id'] = self::getMainCategoryId($parentCategory, $category);
        if ($parentCategory) {
            $data['depth'] = $parentCategory->depth + 1;
            try {
                DB::beginTransaction();
                $category->update($data);
                self::attachVariantToCategory($category, $data['variants'], true);
                self::attachCategoryProperties($request, $category, true);
                self::attachCategoryBrands($request, $category, true);
                DB::commit();
            } catch (Exception $exception) {
                Log::error($exception);
                DB::rollBack();
            }
        } else {
            $category->update($data);
        }
        return httpResponse([
            'message' => 'با موفقیت ویرایش شد.',
            'parent_id' => $parent_id
        ], 200);
    }

    public static function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return httpResponse('با موفقیت حذف شد.', 200);
    }

    public static function getMainCategoryId($parentCategory, $category = null)
    {
        $main_category_id = null;
        if ($parentCategory) {
            $main_category_id = $parentCategory->main_category_id ? $parentCategory->main_category_id : $parentCategory->id;
        } else if ($category) {
            $main_category_id = $category->main_category_id ? $category->main_category_id : $category->id;
        }
        return $main_category_id;
    }

    private static function attachVariantToCategory(Category $category, $variants = [], $update = false)
    {
        /** @var Category $category */
        if ($update) {
            $category->variants()->sync($variants);
        } else {
            $category->variants()->attach($variants);
        }

    }

    private static function attachCategoryProperties(Request $request, Category $category, $update = false)
    {
        if ($update) {
            $category->properties()->sync($request->properties);
        } else {
            $category->properties()->attach($request->properties);
        }
    }

    private static function attachCategoryBrands(Request $request, Category $category, $update = false)
    {
        if ($update) {
            $category->brands()->sync($request->brands);
        } else {
            $category->brands()->attach($request->brands);
        }
    }

    public static function getCategories($parent_id = null)
    {
        $categories =Category::where('parent_id', $parent_id)->get()->toArray();
        foreach ($categories as $category) {
            $children = (array)self::getCategories($category['id']);
            if (sizeof($children) > 0) {
                $category['children'] = $children;
            }
            @$data[] = $category;
        }
        return @$data;
    }


}
