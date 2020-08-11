<?php


namespace Modules\Brand\Service;




use Modules\Brand\Entities\Brand;
use Modules\Brand\Http\Request\CreateBrandRequest;
use Modules\Brand\Http\Request\UpdateBrandRequest;
use Modules\Brand\Http\Request\UploadImageBrandRequest;
use URL;

class BrandService
{

    public static function index()
    {
        return Brand::get();
    }

    public static function store(CreateBrandRequest $request)
    {
        $data = $request->validated();
        Brand::create($data);
        return httpResponse([
            'message' => ' با موفقیت ذخیره شد.',
        ], 200);
    }

    public static function update(UpdateBrandRequest $request, $id)
    {
        $slider = Brand::findOrFail($id);
        $data = $request->validated();
        $slider->update($data);
        return httpResponse([
            'message' => ' با موفقیت ویرایش شد.',
        ], 200);
    }

    public static function destroy($id)
    {
        $slider = Brand::findOrFail($id);
        $slider->delete();
        return httpResponse([
            'message' => '  با موفقیت حذف شد.',
        ], 200);
    }

}
