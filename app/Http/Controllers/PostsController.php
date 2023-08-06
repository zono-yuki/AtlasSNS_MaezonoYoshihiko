<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//これを追加したらAuth認証できた

use App\Http\Requests\PostFormRequest;//PostFormRequestファイルを作ったのでuseで使えるようにする。

class PostsController extends Controller
{

    public function index(){
        //追加
        $user = Auth::user(); //ログイン認証しているユーザーの取得
        $username =Auth::user()->username;

        //追加
        $posts = \DB::table('posts')->get();//テーブルから全データ取得
        //もともとあったやつ
        return view('posts.index')->with('posts', $posts); // ('View側で指定する変数',代入する変数)
    }

    //投稿内容の登録
    public function create(PostFormRequest $request){
        if ($request->isMethod('post')) {
            //リクエストを受け取る。リクエストに内容が入っていたら、ここに入る。postで来ていたらtrueになる。
            //isMethodとは、指定したHTTP動詞（postやget）があっていたらtrueを返す。

            $post = $request->input('post');
            //受け取ったものを変数にはめていく処理

            $user_id = auth()->id();
            //ここはuser_idがnullだとエラーでつぶやきが登録できないため、ログインしているこの、usersテーブルのIDを引っ張ってきて$user_idに格納している処理。

            \DB::table('posts')->insert([
                'user_id' => $user_id,
                'post' => $post,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
            //変数をデータベースのカラムに登録していく処理

            return redirect('top');

            //ここまでがpostの場合の処理
        }
        $validated = $request->validated();
    }

    // 削除機能
    public function delete($id){
        \DB::table('posts')->where('id', $id)->delete();
        return redirect('/top');
    }


    public function followList(){
        return view('follows.followList');
    }

    public function followerList(){
        return view('follows.followerList');
    }
}
