<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
			'name' => 'required|max:191',
			'description' => 'required|max:191',
			'price' => 'required|int|min:0',
			'stock' => 'required|int|min:0'
		];
	}

	public function messages()
	{
		return [
			'name.required' => '商品名は必須です',
			'name.max' => '名前の長さの上限を超えています',
			'description.required' => '商品説明は必須です',
			'description.max' => '商品説明の上限の長さを超えています。',
			'price.required' => '値段は必須です',
			'price.int' => '値段は整数です',
			'price.min' => '値段は０以上にしてください',
			'stock.required' => '在庫は必須です',
			'stock.int' => '在庫数は整数です',
			'stock.min' => '在庫数は０以上にしてください'
		];
	}
}
