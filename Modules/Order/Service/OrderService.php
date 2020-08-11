<?php
namespace Modules\Order\Service;

use DB;
use Log;
use Modules\Order\Entities\Order;
use Modules\Order\Http\Requests\UpdateOrderRequest;
use Throwable;

class OrderService {

    public static function index(){
        $order=Order::latest()->paginate(20);
        return $order;
    }  
    
    public static function update(UpdateOrderRequest $request ,$id){
        $order=Order::findOrFail($id);
        $data=$request->validated();
        try{
            DB::beginTransaction();
            $order->update($data);
            DB::commit();
        }catch(Throwable $throwable){
            Log::error($throwable);
            DB::rollBack();
        }

        return httpResponse('.با موفقیت ویرایش شد');


    }


    public static function destroy($id)
    {
        $order=Order::findOrFail($id);
        $order->delete($id);
        return httpResponse('.با موفقیت حذف شد');
    }

}