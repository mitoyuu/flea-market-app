<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name' => [
                'required'
            ],
            'description' => [
                'required',
                'max:255'
            ],
            'price' => [
                'required',
                'integer',
                'min:0'
            ],
            'img' => [
                'required',
                'mimes:jpeg,png'
            ],
            'category_ids' => [
                'required',
                'array'
            ],
            'status_id' => [
                'required',
                'exists:conditions,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',

            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',

            'price.required' => '価格を入力してください',
            'price.integer' => '価格は数字で入力してください',
            'price.min' => '価格は0円以上で入力してください',

            'img.required' => '商品画像を選択してください',
            'img.mimes' => '画像はjpegまたはpng形式でアップロードしてください',

            'category_ids.required' => 'カテゴリーを選択してください',

            'status_id.required' => '商品の状態を選択してください',
        ];
    }
}
