<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:30',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須じゃ。',
            'title.max' => 'タイトルは最大30文字までじゃ。',
            'message.required' => 'メッセージは必須じゃ。',
        ];
    }
}
