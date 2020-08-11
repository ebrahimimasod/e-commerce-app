<?php

namespace Modules\Variant\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Variant\Http\Request\CreateVariantValueRequest;
use Modules\Variant\Http\Request\UpdateVariantValueRequest;
use Modules\Variant\Service\VariantService;

class VariantController extends Controller
{

    public function index()
    {
        return VariantService::getVariants();
    }

    public function getVariantValues($variant_id)
    {
        return VariantService::getVariantValues($variant_id);
    }


    public function store(CreateVariantValueRequest $request)
    {
        return VariantService::store($request);
    }


    public function update(UpdateVariantValueRequest $request, $id)
    {
        return VariantService::update($request,$id);
    }

    public function destroy($id)
    {
        return VariantService::destroy($id);
    }
}
