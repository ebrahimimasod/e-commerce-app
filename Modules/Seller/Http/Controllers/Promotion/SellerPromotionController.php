<?php

namespace Modules\Seller\Http\Controllers\Product;

use Illuminate\Routing\Controller;
use Modules\Product\Http\Request\CreateProductRequest;
use Modules\Product\Http\Request\UpdateProductRequest;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Service\SellerService;

class SellerPromotionController extends Controller
{

    public function index()
    {

    }


    public function store(CreateProductRequest $request)
    {
        return SellerService::productStore($request);
    }



}
