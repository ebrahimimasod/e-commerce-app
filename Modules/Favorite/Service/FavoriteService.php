<?php


namespace Modules\Favorite\Service;


use Modules\Favorite\Entities\Favorite;
use Modules\Product\Entities\Product;

class FavoriteService
{
    public static function index()
    {
        $favorites = Favorite::where('user_id', auth('api')->id())->latest()->paginate(6);
        return httpResponse($favorites, 200);
    }

    public static function add($product_id)
    {
        $product = Product::where('id', $product_id)->firstOrFail();
        $user_id = auth('api')->id();
        $condition = [
            'user_id' => $user_id,
            'product_id' => $product->id,
        ];
        $favorite = Favorite::where($condition)->first();
        if ($favorite) {
            $favorite->delete();
            return httpResponse('از علاقمندی های شما حذف شد.');
        } else {
            Favorite::create($condition);
            return httpResponse('به علاقمندی های شما اضافه شد.');
        }
    }

    public static function reset()
    {
        Favorite::where('user_id', auth('api')->id())->delete();
    }
}
