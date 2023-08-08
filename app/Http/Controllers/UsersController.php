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


    //ユーザー検索画面を表示させる処理(ユーザー一覧をページネートで取得する)
    public function search(){
        $users = User::paginate(20);
        return view('users.search')->with('users',$users);
        //viewに$users(usersテーブルの情報)を送る。paginateは「ページごと」に表示するアイテムの数
    }



    //ユーザー検索の処理を実装する
    public function searchView(Request $request){
        $keyword = $request->input('keyword');
        $query = User::query();
    //  dd($query);

    //  dd($username);
        if (!empty($keyword)) {//$keywordがnullでなければ入る。
            $query -> orwhere('username','like','%'.$keyword.'%')
            ->get();//orWhereは複数条件を扱える。
        }

    //  全件取得＋ページネーション
        $data= $query->orderBy('created_at','desc')->paginate(5);
        //  dd(data);
        return view('users.search')->with('data',$data)->
        with('keyword',$keyword)->with('users',$users)->with('query',$query);
    }
}
