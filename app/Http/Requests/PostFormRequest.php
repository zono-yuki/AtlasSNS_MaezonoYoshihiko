<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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


     public function rules()//つぶやきのバリデーションルール
    {
        return [
            //'項目名' => '検証ルール｜検証ルール｜検証ルール',
            'post' => 'required|string|min:1|max:150'
        ];
    }

    public function messages()//エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'post.required' => 'つぶやきは入力必須です。',
            'post.min ' => 'つぶやきは1文字以上で入力して下さい。',
            'post.max' => 'つぶやきは150文字以下で入力して下さい。'
        ];
    }
}
