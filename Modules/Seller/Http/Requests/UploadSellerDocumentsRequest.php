<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadSellerDocumentsRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:sellers', new CheckUserForUploadDocRule($this->email, $this->mobile)],
            'mobile' => ['required', 'numeric', 'regex:/^((09)[0-9]{9})$/', 'exists:sellers', new CheckUserForUploadDocRule($this->email, $this->mobile)],
            'national_card_front_doc' => ['required', 'file', 'image', 'max:5120', 'mimes:jpg,png,jpeg', new CheckSellerDocumentExistRule($this->email, $this->mobile)],
            'national_card_back_doc' => ['required', 'file', 'image', 'max:5120', 'mimes:jpg,png,jpeg', new CheckSellerDocumentExistRule($this->email, $this->mobile)],
        ];
    }
}
