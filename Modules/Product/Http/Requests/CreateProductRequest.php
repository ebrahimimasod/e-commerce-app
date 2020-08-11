<?php

namespace Modules\Product\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Entities\Product;

class CreateProductRequest extends FormRequest
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
        $productStatus=join(',',Product::STATUS);
        return [
            'title_fa'          =>  'required|string',
            'title_en'          =>  'nullable|string',
            'category_id'       =>  'required|numeric|exists:categories,id',
            'brand_id'          =>  'required|numeric|exists:brands,id',
            'status'            =>  ['nullable','boolean','in:'.$productStatus],
            'description'       =>  'nullable|array',
            'body'              =>  'nullable|string',
            'images'            =>  'required|array|min:1',
            'videos'            =>  'nullable|array',
            'properties'        =>  'required|array',
            'properties.*'      =>  'nullable|array',
            'meta_title'        =>  'nullable|string',
            'meta_description'  =>  'nullable|string',
            'meta_keywords'     =>  'nullable|string',
        ];
    }
}
