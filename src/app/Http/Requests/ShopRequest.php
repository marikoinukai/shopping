<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            //    
           'product_id' => ['required','integer','exists:products,id'],
           'quantity' => ['required', 'integer', 'min:1'],
            
        ];
    }


         public function messages()
     {
         return [
             'product_id.required' => '商品を選択してください',
             'quantity.required' => '数量を入力してください',
             'quantity.min' => '数量は1以上で入力してください',
         ];
     }
}
