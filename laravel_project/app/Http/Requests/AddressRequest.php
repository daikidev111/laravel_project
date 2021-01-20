<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AddressRequest extends FormRequest
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
			'name' => 'required|alpha|max:191',
			'postal_code' => 'required|regex:/^\d{7}$/',
			'prefecture' => 'required|in:北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県,海外',
			'city' => 'required|alpha|max:191',
			'building' => 'required|max:191',
			'phone' => 'required|integer|digits_between:8,11',
        ];
	}

	public function messages()
	{
		return [
			'name.required' => '氏名は必須です',
			'name.alpha' => '氏名に数字または記号が含まれています',
			'name.max' => '名前の上限を超えました',
			'postal_code.required' => '郵便番号は必須です',
			'postal_code.regex' => '郵便番号は７桁の数字です',
			'prefecture.required' => '都道府県は必須です',
			'prefecture.in' => '都道府県を記入してください',
			'city.required' => '市町村区は必須です',
			'city.alpha' => '市町村区に数字または記号が含まれています',
			'city.max' => '市町村区の上限の長さを超えました',
			'building.required' => 'それ以下の住所は必須です',
			'building.max' => 'それ以下の住所の上限の長さを超えました',
			'phone.required' => '電話番号は必須です',
			'phone.integer' => '電話番号は数字です',
			'phone.digits_between' => '電話番号は８桁から１１桁です',
		];
	}
}
