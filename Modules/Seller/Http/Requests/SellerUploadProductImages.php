<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerUploadProductImages extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'=>'required|file|image|max:5120|mimes:jpg,png,jpeg|dimensions:min_width=600,min_height=600,max_width=5000,max_height=5000,ratio=1/1'
        ];
    }
}
