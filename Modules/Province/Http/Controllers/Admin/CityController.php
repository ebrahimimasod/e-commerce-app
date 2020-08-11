<?php

namespace Modules\Province\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Province\Http\Request\CreateProvinceRequest;
use Modules\Province\Http\Request\UpdateProvinceRequest;
use Modules\Province\Service\CityService;
use Modules\Province\Service\ProvinceService;

class CityController extends Controller
{

    public function index($province_id)
    {
       return  CityService::getProvinceCities($province_id);
    }

    public function store(CreateProvinceRequest $request,$province_id)
    {
        return CityService::store($request,$province_id);
    }


    public function update(UpdateProvinceRequest $request, $id)
    {
        return CityService::update($request,$id);
    }


    public function destroy($id)
    {
        return CityService::destroy($id);
    }
}
