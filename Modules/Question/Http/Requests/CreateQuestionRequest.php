<?php

namespace Modules\Question\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Question\Rules\CheckParentIdQuestion;

class CreateQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'body'      => ['required','string','max:10000'],
           'parent_id' => ['bail','nullable','numeric','exists:questions,id',new CheckParentIdQuestion()],
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
