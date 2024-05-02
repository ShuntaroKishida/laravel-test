<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'コメント内容は必須じゃ。',
            'content.max' => 'コメントは最大50文字までじゃ。',
        ];
    }
}
