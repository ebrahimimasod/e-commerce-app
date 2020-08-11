<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSellerRequest extends FormRequest
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
            'email'    => 'required|email|unique:sellers|max:50',
            'mobile'   => 'required|numeric|unique:sellers|regex:/^((09)[0-9]{9})$/',
            'password' => 'required|string|max:50|min:6',
        ];
    }
}
