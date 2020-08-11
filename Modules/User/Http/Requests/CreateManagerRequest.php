<?php

namespace Modules\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Entities\User;

class CreateManagerRequest extends FormRequest
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
        $userLevels = join(',', collect(User::LEVELS)->map(function ($level) {
            return $level['value'];
        })->toArray());
        return [
            'first_name'  => 'required|string|max:50',
            'last_name'   => 'required|string|max:50',
            'mobile'      => 'required|string|unique:users,mobile|regex:~^09\d{9}$~',
            'email'       => 'nullable|email|unique:users',
            'password'    => 'required|min:6|max:50',
            'status'      => 'required|boolean',
            'role'        => 'required|numeric|exists:roles,id',
        ];
    }
}
