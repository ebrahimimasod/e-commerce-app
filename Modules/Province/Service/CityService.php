<?php


namespace Modules\Province\Service;




use Modules\Province\Entities\City;
use Modules\Province\Http\Request\CreateProvinceRequest;
use Modules\Province\Http\Request\UpdateProvinceRequest;


class CityService
{

    public static function getProvinceCities($province_id)
    {
        return $cities = City::where('province_id', $province_id)->get();
    }

    public static function store(CreateProvinceRequest $request, $province_id)
    {
        $data = $request->validated();
        $data['province_id'] = $province_id;
        City::create($data);
        return httpResponse('شهر با موفقیت ذخیره شد.');
    }

    public static function update(UpdateProvinceRequest $request, $city_id)
    {
        $data = $request->validated();
        $city = City::findOrFail($city_id);
        $city->update($data);
        return httpResponse('شهر با موفقیت ویرایش شد.');
    }

    public static function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return httpResponse('با موفقیت حذف شد.');
    }


}
