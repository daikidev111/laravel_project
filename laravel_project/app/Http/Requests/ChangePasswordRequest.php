<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
			'current_password' => 'required|max:191',
			'new_password' => 'required|max:191|min:6',
			'confirm_password' => 'required|same:new_password|max:191',
        ];
	}

	public function messages()
	{
		return [
			'current_password.required' => '現在のパスワードは必須です。',
			'current_password.max' => 'パスワードの長さの上限を超えています。',
			'new_password.required' => '新しいパスワードは必須です。',
			'new_password.max' => '新しいパスワードの長さの上限を超えています。',
			'new_password.min' => '新しいパスワードは６文字以上です。',
			'confirm_password.required' => '確認用パスワードは必須です。',
			'confirm_password.same' => '新しいパスワードと一致しませんでした。',
			'confirm_password.max' => '確認用パスワードの長さの上限を超えています。',
		];
	}
}
