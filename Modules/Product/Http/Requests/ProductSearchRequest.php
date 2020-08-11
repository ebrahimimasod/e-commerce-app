<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Service\SearchService;

class ProductSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $sorts = join(',',
            collect(SearchService::getSearchResultSort())->map(function ($item) {
                return $item['id'];
            })->toArray());
        return [
            'q'                  => 'nullable|string',
            'has_selling_stock'  => 'nullable|boolean',
            'colors'             => 'nullable|array',
            'colors.*'           => 'nullable|exists:colors,id',
            'price'              => 'nullable|array',
            'price.*'            => 'nullable|numeric',
            'brands'             => 'nullable|array',
            'brands.*'           => 'nullable|exists:brands,id',
            'sizes'              => 'nullable|array',
            'sizes.*'            => 'nullable|exists:sizes,id',
            'sortby'             => 'nullable|in:'.$sorts,
            'properties'         => 'nullable|array',
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
