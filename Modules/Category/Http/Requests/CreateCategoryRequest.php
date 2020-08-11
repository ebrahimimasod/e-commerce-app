<?php

namespace Modules\Category\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name_fa'       => 'required|string',
            'name_en'       => 'required|string',
            'image'         => 'nullable|string',
            'display'       => 'required|boolean',
            'status'        => 'required|boolean',
            'parent_id'     => 'nullable|numeric|exists:categories,id',
            'properties'    => 'required_with:parent_id|array',
            'properties.*'  => 'required_with:properties,null|exists:properties,id',
            'variants'      => 'nullable|array',
            'variants.*'    => 'required_with:variants,null|exists:variants,id',
            'brands'        => 'required_with:parent_id|array',
            'brands.*'      => 'required_with:brands,null|exists:brands,id',
            'rating'        => 'nullable|array',
        ];
    }
}
