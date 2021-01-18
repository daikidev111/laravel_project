<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
			'quantity' => 'required|min:1',
		];
	}

	public function messages()
	{
		return [
			'quantity.min' => 'カートに追加する商品は最低１つ以上です',
			'quantity.required' => 'カートへ追加する際は個数の指定が必要です'
		];
	}
}
