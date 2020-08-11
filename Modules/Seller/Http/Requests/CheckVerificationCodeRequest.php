<?php

namespace Modules\Seller\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\Seller\Rules\CheckForExistsSellerDataRule;
use Modules\Seller\Rules\CheckVerificationCodeRule;

class CheckVerificationCodeRequest extends FormRequest
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
            'email'   => ['required','email',new CheckForExistsSellerDataRule()],
            'mobile'  => ['nullable','numeric','regex:/^((09)[0-9]{9})$/'],
            'code'    => ['required', 'string', 'size:6', new CheckVerificationCodeRule($this->email,$this->mobile)],
        ];
    }
}
