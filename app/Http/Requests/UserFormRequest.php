<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //フォームリクエストを使う際は、ここをfalseからtrueに変えないと、403エラーになるので、trueに変える。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //ログインユーザーのプロフィール更新時のバリデーションルール
            //'項目名' => '検証ルール｜検証ルール｜検証ルール',
            'username' => 'required|string|min:2|max:12',

            //★ここを、自分のメールアドレスを除く同じアドレスがあったらはじくようにする。this->id.',id',???
            'mail' => 'required|string|min:5|max:40|email|unique:users,mail,'.$this->id.',id', //usersテーブルのmailカラムで一意メールアドレスの形式であるかどうか

            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|confirmed:password',
            'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
            'bio' =>'max:150',
            'icon_image' =>'mimes:jpg,png,bmp,gif,svg',
        ];
    }


    public function messages()
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'username.required' => 'ユーザー名は入力必須です。',
            'username.min ' => 'ユーザー名は2文字以上で入力して下さい。',
            'username.max' => 'ユーザー名は12文字以下で入力して下さい。',

            'mail.required' => 'メールアドレスは入力必須です。',
            'mail.min' => 'メールアドレスは5文字以上で入力して下さい。',
            'mail.max' => 'メールアドレスは40文字以下で入力して下さい。',
            'mail.unique' => '登録済みのメールアドレスは使用不可です。',
            'mail.email' => 'メールアドレスの形式で入力して下さい。',

            'password.required' => 'パスワードは入力必須です。',
            'password.regex' => 'パスワードは英数字のみで入力して下さい。',
            'password.min' => 'パスワードは8文字以上で入力して下さい。',
            'password.max' => 'パスワードは20文字以下で入力して下さい。',
            'password.confirmed' => 'パスワードが一致しません。',

            'bio.max' => '自己紹介は150文字以下で入力してください。',

            //アイコンの画像などのエラーメッセージを入れる。（画像(jpg、png、bmp、gif、svg)ファイル以外は不可）
        ];
    }
}
