<?php


namespace Modules\Seller\Service;


use Modules\Product\Entities\Product;
use Modules\Product\Http\Request\CreateProductRequest;
use Modules\Product\Http\Request\UpdateProductRequest;
use Modules\Product\Service\ProductService;

trait SellerProductTrait
{
    public static function productStore(CreateProductRequest $request)
    {
        $request->merge(['status' => Product::DISABLE_STATUS]);
        return ProductService::store($request, true);
    }

    public static function productEdit($id)
    {
        return ProductService::edit($id,true);
    }


    public static function productUpdate(UpdateProductRequest $request, $id)
    {
        $request->merge(['status' => Product::DISABLE_STATUS]);
        return ProductService::update($request, $id, true);
    }
}
