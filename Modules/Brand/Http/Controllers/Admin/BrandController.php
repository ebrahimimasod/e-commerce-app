<?php

namespace Modules\Brand\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Brand\Http\Request\CreateBrandRequest;
use Modules\Brand\Http\Request\UpdateBrandRequest;
use Modules\Brand\Http\Request\UploadImageBrandRequest;
use Modules\Brand\Service\BrandService;

class BrandController extends Controller
{

    public function index()
    {
        return BrandService::index();
    }

    public function store(CreateBrandRequest $request)
    {
        return BrandService::store($request);
    }


    public function update(UpdateBrandRequest $request, $id)
    {
        return BrandService::update($request, $id);
    }


    public function destroy($id)
    {
        BrandService::destroy($id);
    }
}
