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
            'product_name' => ['required', 'string', 'max:20','unique:products'],        
            'price' => ['required', 'numeric', 'min:1'],
            'category_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_name.string' => '商品名を文字列で入力してください',
            'product_name.max' => '商品名を20文字以下で入力してください',
            'price.required' => '価格を入力してください',
            'price.min' => '価格は1円以上で入力してください',
            'category_id.required' => 'カテゴリーを選んでください',
            'product_name.unique' => '商品が既に存在しています',
        ];
    }
}
