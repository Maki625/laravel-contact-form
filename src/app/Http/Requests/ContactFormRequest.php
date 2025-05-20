<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 認証が不要な場合はtrueを返す
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',   // 姓は必須
            'last_name' => 'required|string|max:255',    // 名は必須
            'gender' => 'required|in:男性,女性,その他',

            'email' => 'required|email',

            'tel1' => 'required | max:5 | regex:/^[0-9]+$/',
            'tel2' => 'required | max:5 | regex:/^[0-9]+$/',
            'tel3' => 'required | max:5 | regex:/^[0-9]+$/',

            'address' => 'required',       // 住所は必須
            'inquiry_type' => 'required', // 問い合わせ種類は必須
            'inquiry_content' => 'required|max:120',  // 問い合わせ内容は必須、最大120文字
        ];
    }

    /**
     * Get the custom error messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'gender.in' => '性別の選択が正しくありません',
            'email.required' => 'メールアドレスを入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.regex' => '電話番号は半角数字で入力してください',
            'tel1.max' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.regex' => '電話番号は半角数字で入力してください',
            'tel2.max' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.regex' => '電話番号は半角数字で入力してください',
            'tel3.max' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'inquiry_content.required' => 'お問い合わせ内容を入力してください',
            'inquiry_content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
