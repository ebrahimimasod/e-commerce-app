<?php

namespace Modules\Property\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Property\Http\Request\CreatePropertyRequest;
use Modules\Property\Http\Request\UpdatePropertyRequest;
use Modules\Property\Service\PropertyService;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        return  PropertyService::index($request);
    }


    public function store(CreatePropertyRequest $request)
    {
        return  PropertyService::store($request);
    }


    public function update(UpdatePropertyRequest $request, $id)
    {
        return  PropertyService::update($request,$id);
    }

    public function destroy($id)
    {
        return  PropertyService::destroy($id);
    }
}
