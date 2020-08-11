<?php

namespace Modules\Order\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Order\Http\Requests\UpdateOrderRequest;
use Modules\Order\Service\OrderService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      return OrderService::index();
    }

    
    
    public function update(UpdateOrderRequest $request, $id)
    {
        return OrderService::update($request, $id);
    }

   
    public function destroy($id)
    {
        return OrderService::destroy( $id);
    }
}
