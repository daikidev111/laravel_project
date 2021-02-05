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
			'stock' => 'required|integer|min:0|max:99999',
			//'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
		];
	}

	public function messages()
	{
		return [
			'name.required' => '商品名は必須です',
			'name.max' => '名前の長さの上限を超えています',
			'description.required' => '商品説明は必須です',
			'description.max' => '商品説明の上限の長さを超えています',
			'stock.required' => '在庫は必須です',
			'stock.integer' => '在庫数は整数です',
			'stock.min' => '在庫数は０以上にしてください',
			'stock.max' => '在庫数は最大値を超えています',
			'image.image' => '画像ファイルを指定してください',
			'image.mimes' => 'jpeg, png, jpg, gifの内いずれかの形式の画像ファイルを指定してください',
			'image.max' => '2048MB以下の画像ファイルを指定してください',
		];
	}
}
