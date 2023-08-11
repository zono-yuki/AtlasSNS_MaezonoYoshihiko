<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PostFormRequest;//PostFormRequestファイルを作ったのでuseで使えるようにする。
use App\Post;
use App\User;

class PostsController extends Controller
{

    public function index(){
        //追加Auth認証
        $user = Auth::user(); //ログイン認証しているユーザーの取得
        // $username =Auth::user()->username;
        $username = $user->username;


        //Postテーブルから降順で全てのデータを取得する。
        $posts = Post::orderBy('created_at','desc')->get();

        return view('posts.index',compact('posts','user','username'));//$postsを送るが、postsと書く。
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

            Post::insert([
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
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

    // 更新処理
    public function update(Request $request){
        //1つ目の処理
        $id = $request->input('id');
        $posts = $request->input('post');
        //2つ目の処理
        Post::where('id', $id)->update([
            'post' => $posts
        ]);
        return redirect('/top');
    }


    public function followList(){
        return view('follows.followList');
    }

    public function followerList(){
        return view('follows.followerList');
    }
}
