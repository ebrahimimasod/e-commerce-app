<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\ProductSearchRequest;
use Modules\Product\Service\ProductService;


class ProductController extends Controller
{
    public function productSearch(ProductSearchRequest $request,$category=null)
    {
        return ProductService::doSearch($request,$category);
    }
}
