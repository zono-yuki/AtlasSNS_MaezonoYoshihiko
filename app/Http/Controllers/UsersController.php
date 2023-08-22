<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Follow;


class UsersController extends Controller
{
    //プロフィール画面を表示させる処理
    public function profile(Int $id){

        //リンク元のidを元にユーザー情報を取得する
        $users = User::where('id', $id)->first();
        // dd($users);

        //リンク元ユーザーのidを元に投稿内容を取得する
        // $posts = Post::with('user')->whereIn('user_id', $users)->get;
        // $posts = Post::with('user')->whereIn('id', $id )->get;

        // dd($posts);

        // return view('users.profile', ['user_id' => $id ]) ->with('users', $users)->with('posts',$posts);
        // return view('users.profile', ['user_id' => $id])->with('users', $users);
        return view('users.profile')->with('users', $users);


    }

    // フォローを解除する（相手プロフィール画面でのフォロー解除ボタン）
    //フォロー解除///////
        public function unfollow(Int $user_Id) //$userIdは相手のid
        {
            // フォローしているか
            $follower = auth()->user();
            $is_following = $follower->isFollowing($user_Id); //相手のidを飛ばして登録しているか確認する

            // フォローしていれば下記のフォロー解除を実行する
            if ($is_following) {

                $loggedInUserId = auth()->user()->id; //自分のIDを取得
                // フォローしたい人のユーザーIDを元にユーザーを取得
                $followedUser = User::find($user_Id); //ユーザーテーブルからその相手の情報を全部入れる。
                $followedUserId = $followedUser->id; //その情報からidを取得する。

                Follow::where([ //中間テーブルを探す
                    ['following_id', '=', $loggedInUserId], //自分のID
                    ['followed_id', '=', $followedUserId], //自分がフォローしている相手のID
                ])
                    ->delete();
            }
            return redirect('/profile/{$user_Id}/view');
        }

    //フォローする///////（相手プロフィール画面でのフォローするボタン）$userIdは相手のid
    public function follow(Int $user_Id)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user_Id);

        // フォローしていなかったら下記のフォロー処理を実行
        if (!$is_following) {
            // 自分のユーザーIDを取得
            $loggedInUserId = auth()->user()->id;
            // フォローしたい人のユーザーIDを元にユーザーを取得
            $followedUser = User::find($user_Id); //ユーザーテーブルからその相手の情報を全部入れる。
            $followedUserId = $followedUser->id; //その情報からidを取得する。

            // フォローデータをデータベースに登録
            Follow::create([
                'following_id' => $loggedInUserId, //自分のIDを登録する。
                'followed_id' => $followedUserId, //フォローする相手のIDを登録する。
            ]);
            return redirect('/profile/{$user_Id}/view'); // フォロー後に元のページにリダイレクト
        }
    }


    //検索処理の実行
    public function search(Request $request){

        $user= Auth::user();//ログインユーザー取得

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
