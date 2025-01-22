<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255', // string と max ルールを追加',
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'nullable|array', // array 型指定を追加',
            'description' => 'nullable|string|max:120', // 商品説明の文字数制限を追加
            'image' => 'nullable|image|mimes:png,jpeg,jpg|max:2048', // max サイズ制限を追加
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0～10000円以内で入力してください',
            'price.max' => '0～10000円以内で入力してください',
            'season.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
