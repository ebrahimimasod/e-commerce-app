<?php

namespace Modules\Brand\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandRequest extends FormRequest
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
            'name_fa'   => 'required|string|max:50',
            'name_en'   => 'nullable|string|max:50',
            'image'     => 'nullable|url',
            'status'    => 'required|boolean',
        ];
    }
}
