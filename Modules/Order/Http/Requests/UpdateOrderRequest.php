<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Order\Entities\Order;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $orderStatus=join(',',Order::STATUS);
        return [
            'price_total'    => 'required|string|max:255',
            'price_final'    => 'required|string|max:255',
            'postage_fee'    => 'required|string|max:255',
            'status'         => 'required|string|in:'.$orderStatus,
          
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
