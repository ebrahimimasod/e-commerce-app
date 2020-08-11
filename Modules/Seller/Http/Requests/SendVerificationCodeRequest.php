<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Seller\Rules\CheckForExistsSellerDataRule;

class SendVerificationCodeRequest extends FormRequest
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
            'type'   => ['required','in:email,mobile'],
            'email'  => ['required','email',new CheckForExistsSellerDataRule()],
            'mobile' => ['required_without:type,email','numeric','regex:/^((09)[0-9]{9})$/'],
        ];
    }
}
