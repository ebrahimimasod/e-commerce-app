<?php

namespace Modules\Role\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name'          => 'required|string|max:50',
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'required|numeric|exists:permissions,id',
        ];
    }
}
