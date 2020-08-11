<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Comment\Entities\Comment;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $status=join(',',Comment::STATUS);
        return [
           'title'         => 'required|string|max:100',
           'body'          => 'nullable|string|max:10000',
           'good_tags'     => 'nullable|array|max:5',
           'bad_tags'      => 'nullable|array|max:5',
           'status'        => 'required|in:'.$status,
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
