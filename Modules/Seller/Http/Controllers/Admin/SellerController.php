<?php

namespace Modules\Seller\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Seller\Http\Requests\CreateSellerRequest;
use Modules\Seller\Http\Requests\UpdateSellerRequest;
use Modules\Seller\Service\SellerService;

class SellerController extends Controller
{

    public function index()
    {
        return SellerService::index();
    }

    public function store(CreateSellerRequest $request)
    {
        return SellerService::store($request);
    }


    public function update(UpdateSellerRequest $request,$id)
    {
        return SellerService::update($request,$id);
    }

    public function destroy($id)
    {
        return SellerService::destroy($id);
    }
    public function forceDestroy($id)
    {
        return SellerService::destroy($id,true);
    }
}
