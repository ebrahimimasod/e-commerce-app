<?php

namespace Modules\Promotion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromotionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price'            => ['required','string'],
            'discount'         => ['required','numeric','min:0','max:100'],
            'product_id'       => ['required','numeric','exists:products,id'],
            'seller_id'        => ['required','numeric','exists:sellers,id'],
            'variant_value_id' => ['required','numeric','exists:variant_values,id'],
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
