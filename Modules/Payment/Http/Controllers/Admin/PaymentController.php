<?php

namespace Modules\Payment\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;
use Modules\Payment\Service\PaymentService;

class PaymentController extends Controller
{
    
    public function index()
    {
        return PaymentService::index();
    }

 
    
    public function update(UpdatePaymentRequest $request, $id)
    {
        return PaymentService::update($request, $id);
    }

    public function destroy($id)
    {
        return PaymentService::destroy($id);
    }
}
