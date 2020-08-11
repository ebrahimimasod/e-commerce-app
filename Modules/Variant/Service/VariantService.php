<?php


namespace Modules\Variant\Service;




use Modules\Variant\Entities\Variant;
use Modules\Variant\Entities\VariantValue;
use Modules\Variant\Http\Request\CreateVariantValueRequest;
use Modules\Variant\Http\Request\UpdateVariantValueRequest;

class VariantService
{

    public static function getVariants()
    {
        return Variant::get();
    }


    public static function store(CreateVariantValueRequest $request)
    {
        $data = $request->validated();
        VariantValue::create($data);
        return httpResponse([
            'message' => ' با موفقیت ذخیره شد.',
        ], 200);
    }


    public static function update(UpdateVariantValueRequest $request, $id)
    {
        $slider = VariantValue::findOrFail($id);
        $data = $request->validated();
        $slider->update($data);
        return httpResponse([
            'message' => ' با موفقیت ویرایش شد.',
        ], 200);
    }


    public static function destroy($id)
    {
        $slider = VariantValue::findOrFail($id);
        $slider->delete();
        return httpResponse([
            'message' => '  با موفقیت حذف شد.',
        ], 200);
    }

    public static function getVariantValues($variant_id)
    {
        return VariantValue::where('variant_id', $variant_id)->get();
    }


}
