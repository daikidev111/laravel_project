<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class ChangeEmailRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|alpha|max:191',
			'email' => [
				'required',
				'max:191',
				'email',
				//https://stackoverflow.com/questions/47646900/laravel-how-to-use-the-ignore-rule-in-form-request-validation
				Rule::unique('users', 'email')->ignore(Auth::user()->email, 'email'),
			],
		];
	}


	public function messages()
	{
		return [
			'name.required' => '名前は必須です',
			'name.alpha' => '名前に数字または記号が含まれています',
			'name.max' => '名前を191文字以内で入力してください',
			'email.required' => 'メールアドレスは必須です',
			'email.unique' => '入力されたメールアドレスは既に使われています',
			'email.max' => 'メールアドレスを191文字以内で入力してください',
			'email.email' => 'メールアドレスが正しくありません',
		];
	}
}
