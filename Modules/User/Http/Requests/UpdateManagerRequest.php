<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateManagerRequest extends FormRequest
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
     //   dd($this->id);
        return [
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'mobile'     => ['required','string','regex:~^09\d{9}$~',Rule::unique('users')->ignore($this->id)],
            'email'      => ['nullable','email',Rule::unique('users')->ignore($this->id)],
            'password'   => 'nullable|min:6|max:50',
            'status'     => 'required|boolean',
            'role'       => 'required|numeric|exists:roles,id',

        ];
    }
}
