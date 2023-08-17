<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    //プロフィール画面を表示させる処理
    public function profile(){
        return view('users.profile');
    }


    //検索処理の実行
    public function search(Request $request){

        $user= Auth::user();

        //キーワード受け取り
        $keyword = $request->input('keyword');
        // dump($keyword);

        //データベースに問い合わせ
        if (!empty($keyword)) {//キーワードが入力されていたら、、
            $query = User::query();
            $query->where('username', 'LIKE' , "%{$keyword}%");
            $users = $query->get();
            return view('users.search',compact('user','users','keyword',));
            //①ログインしているユーザーの情報, ②キーワードに少しでも一致したuser情報, ③入力されたキーワード を送る
        }else{
            $users = User::get();

            return view('users.search',compact('user','users','keyword',));
            //①ログインしているユーザーの情報, ②usersテーブルの全情報, ③入力されたキーワード を送る
        }
    }
}
