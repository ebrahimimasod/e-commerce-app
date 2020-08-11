<?php


namespace Modules\Province\Service;




use Modules\Province\Entities\Province;
use Modules\Province\Http\Request\CreateProvinceRequest;
use Modules\Province\Http\Request\UpdateProvinceRequest;

class ProvinceService
{

    public static function getProvinces()
    {
      return Province::get();
    }


    public static function store(CreateProvinceRequest $request)
    {
        $data = $request->validated();
        Province::create($data);
        return httpResponse([
            'message' => 'استان با موفقیت ذخیره شد.',
        ], 200);
    }


    public static function update(UpdateProvinceRequest $request, $id)
    {
        $province = Province::findOrFail($id);
        $data = $request->validated();
        $province->update($data);
        return httpResponse([
            'message' => 'استان با موفقیت ویرایش شد.',
        ], 200);
    }


    public static function destroy($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();
        return httpResponse([
            'message' => ' استان با موفقیت حذف شد.',
        ], 200);
    }


}
