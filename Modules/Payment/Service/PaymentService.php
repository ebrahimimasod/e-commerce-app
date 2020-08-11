<?php

namespace Modules\Payment\Service;

use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;

class PaymentService{

    public static function index()
    {
        $payment=Payment::latest()->paginate(20);
        return $payment;
    }


    public static function update(UpdatePaymentRequest $request ,$id)
    {
        $payment=Payment::findOrFail($id);
        $payment->update($id);
        return httpResponse('.با موفقیت انجام شد');
    }

    public static function destroy($id)
    {
        $payment=Payment::findOrFail($id);
        $payment->delete();
        return httpResponse('.با موفقیت حذف شد');
    }




}