<?php


namespace Modules\History\Service;


use Modules\History\Entities\History;
use Modules\Product\Entities\Product;

class HistoryService
{
    public static function index()
    {
        $histories = History::where('user_id', auth('api')->id())->latest()->paginate(6);
        return httpResponse($histories, 200);
    }

    public static function add($product_id)
    {
        $product = Product::where('id', $product_id)->firstOrFail();
        $user_id = auth('api')->id();
        $condition = [
            'user_id' => $user_id,
            'product_id' => $product->id,
        ];
        $history = History::where($condition)->first();
        if (!$history) {
            History::create($condition);
        }
    }

    public static function reset()
    {
        History::where('user_id', auth('api')->id())->delete();
    }
}
