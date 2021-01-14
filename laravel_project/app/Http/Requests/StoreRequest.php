<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
			'name' => 'required',
			'description' => 'required',
			'price' => 'required|max:0',
			'stock' => 'required'
        ];
	}

	public function messages ()
	{
		return [
			'name.required' => '商品名は必須です',
			'description.required' => '商品説明は必須です',
			'price.required' => '値段は必須です',
			'stock.required' => '在庫は必須です',
		];
	}

}
