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

            'email.email' => 'メールアドレスはメール形式で入力してください',
                  // メールアドレスは必須でメール形式
            'tel1' => 'required|digits:3',
            'tel2' => 'required|digits:4',
            'tel3' => 'required|digits:4',
            'address' => 'required|string|max:255',       // 住所は必須
            'inquiry_type' => 'required|exists:categories,id', // 問い合わせ種類は必須
            'inquiry_content' => 'required|string|max:120',  // 問い合わせ内容は必須、最大120文字
        ];
    }

    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $tel1 = $this->input('tel1');
        $tel2 = $this->input('tel2');
        $tel3 = $this->input('tel3');

        if (empty($tel1) || empty($tel2) || empty($tel3)) {
            $validator->errors()->add('tel', '電話番号を入力してください');
        }
        // 数字かどうか & 桁数チェック（5桁以内ルール）
        if (
            (!ctype_digit($tel1) || strlen($tel1) > 5) ||
            (!ctype_digit($tel2) || strlen($tel2) > 5) ||
            (!ctype_digit($tel3) || strlen($tel3) > 5)
        ) {
            // 共通のtelキーでエラーメッセージを一回だけ表示
            $validator->errors()->add('tel', '電話番号は5桁までの数字で入力してください');
        }
    });
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
            'tel.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'inquiry_content.required' => 'お問い合わせ内容を入力してください',
            'inquiry_content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
