<?php

namespace Modules\Seller\Http\Controllers\Product;

use Illuminate\Routing\Controller;
use Modules\Product\Http\Request\CreateProductRequest;
use Modules\Product\Http\Request\UpdateProductRequest;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Service\SellerService;

class SellerProductController extends Controller
{

    public function index()
    {
        /** @var Seller $seller */
        $seller = sellerAuth();
        return $sellerProducts = $seller->products;
    }


    public function store(CreateProductRequest $request)
    {
        return SellerService::productStore($request);
    }

    public function edit($id)
    {
        return SellerService::productEdit($id);
    }

    public  function update(UpdateProductRequest $request,$id)
    {
        return SellerService::productUpdate($request,$id);
    }


}
