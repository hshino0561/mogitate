<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255', 
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'required|array|min:1', 
            'description' => 'required|string|max:120',
        ];

        if ($this->has('reg_image')) {
            $rules['reg_image'] = 'required_without:image,ends_with:png,ends_with:jpg,ends_with:jpeg';
        } elseif ($this->has('new_image')) {
            $rules['new_image'] = 'required_without:image,ends_with:png,ends_with:jpg,ends_with:jpeg';
        } else {
            $rules['image'] = 'nullable|file|mimes:png,jpeg,jpg|max:2048';
        }

    return $rules;
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
            'new_image.required_without' => '商品画像を登録してください',
            'reg_image.required_without' => '商品画像を登録してください', // 必須エラー時のメッセージ
            'new_image.regex' => '「.png」または「.jpeg」形式でアップロードしてください',
            'reg_image.ends_with' =>'「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
