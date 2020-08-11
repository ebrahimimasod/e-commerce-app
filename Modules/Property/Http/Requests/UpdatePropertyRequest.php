<?php

namespace Modules\Property\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Property\Entities\Property;

class UpdatePropertyRequest extends FormRequest
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
        $propertiesTypes = join(',', Property::TYPES);
        return [
            'name'        => 'required|string',
            'parent_id'   => 'nullable|numeric|exists:properties,id',
            'search_able' => 'nullable|boolean',
            'data_type'   => ['required_with:parent_id','string', 'in:' . $propertiesTypes],
            'items'       => ['required_if:data_type,select', 'array','min:1'],
            'items.*'     => ['required_if:data_type,select'],
        ];
    }
}
