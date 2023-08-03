<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //プロフィール画面を表示させる処理
    public function profile(){
        return view('users.profile');
    }

    //ユーザー検索画面を表示させる処理
    public function search(){
        return view('users.search');
    }
}
