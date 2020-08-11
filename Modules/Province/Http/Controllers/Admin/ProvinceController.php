<?php

namespace Modules\Province\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Province\Http\Request\CreateProvinceRequest;
use Modules\Province\Http\Request\UpdateProvinceRequest;
use Modules\Province\Service\ProvinceService;

class ProvinceController extends Controller
{

    public function index()
    {
       return  ProvinceService::getProvinces();
    }

    public function store(CreateProvinceRequest $request)
    {
       return ProvinceService::store($request);
    }


    public function update(UpdateProvinceRequest $request, $id)
    {
        return ProvinceService::update($request,$id);
    }


    public function destroy($id)
    {
        return ProvinceService::destroy($id);
    }
}
