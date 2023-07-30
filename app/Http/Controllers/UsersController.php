<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //プロフィール画面を表示させる
    public function profile(){
        return view('users.profile');
    }

    
    public function search(){
        return view('users.search');
    }
}
