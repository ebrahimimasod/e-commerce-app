<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Http\Request\CreateProductRequest;
use Modules\Product\Http\Request\UpdateProductRequest;
use Modules\Product\Service\ProductService;
use Modules\Property\Http\Request\UpdatePropertyRequest;

class ProductController extends Controller
{

    public function index()
    {
        return ProductService::index();
    }

    public function store(CreateProductRequest $request)
    {
        return ProductService::store($request);
    }

    public function edit($product_id)
    {
        return ProductService::edit($product_id);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        return ProductService::update($request,$id);
    }

    public function destroy($id)
    {
        return ProductService::destroy($id);
    }

    public function forceDelete($id)
    {
        return ProductService::destroy($id,true);
    }
}
