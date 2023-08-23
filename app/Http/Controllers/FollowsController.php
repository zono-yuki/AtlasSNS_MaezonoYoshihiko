<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;
use App\Post;



class FollowsController extends Controller
{
    //フォローリストの画面を表示する。フォローしている人のアイコンと、投稿を表示する。

    public function followList(){
        //ログインユーザーがフォローしている人を全部表示する、①これをviewに送る。
        $follows = Auth::user()->follows()->get();

        //フォローしている人のidを取得する。（pluck）
        $following_id = Auth::user()->follows()->pluck('followed_id');

        // dd($following_id);
        //取得できている。

        //Postモデル(postsテーブル)からpostsテーブルのuser_idと$following_idが同じ投稿を新しい順で取得する。(カラム名,条件)②これをviewに送る
        $posts = Post::with('user')->whereIn('user_id',$following_id)->latest()->get();
        // dd($posts);
        //取得できていない。
        return view('follows.followList', ['posts' => $posts, 'follows' => $follows]);
    }

    public function followerList(){
        //フォローワーリストの画面を表示する。フォローされている人のアイコンと、投稿を表示する。


        $followers = Auth::user()->follower()->get();
        // dd($followers);
        //フォローされている人のidを取得する。（pluck）
        $followering_id = Auth::user()->follower()->pluck('following_id');

        // dd($followering_id);
        //取得できている。

        //Postモデル(postsテーブル)からpostsテーブルのuser_idと$followering_idが同じ投稿を新しい順で取得する。(カラム名,条件)②これをviewに送る
        $posts = Post::with('user')->whereIn('user_id', $followering_id)->latest()->get();
        // dd($posts);
        //取得できていない。
        return view('follows.followerList', ['posts' => $posts, 'followers' => $followers]);
    }




    //フォロー解除///////
    public function unfollow(Int $user_Id)//$userIdは相手のid
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user_Id);//相手のidを飛ばして登録しているか確認する

        // フォローしていれば下記のフォロー解除を実行する
        if ($is_following) {

            $loggedInUserId = auth()->user()->id; //自分のIDを取得
            // フォローしたい人のユーザーIDを元にユーザーを取得
            $followedUser = User::find($user_Id); //ユーザーテーブルからその相手の情報を全部入れる。
            $followedUserId = $followedUser->id;//その情報からidを取得する。

            Follow::where([//中間テーブルを探す
                ['following_id', '=', $loggedInUserId], //自分のID
                ['followed_id', '=', $followedUserId],//自分がフォローしている相手のID
            ])
                ->delete();
        }
        return redirect('/search');
    }

    //フォローする///////$userIdは相手のid
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
            $followedUser = User::find($user_Id);//ユーザーテーブルからその相手の情報を全部入れる。
            $followedUserId = $followedUser->id;//その情報からidを取得する。

            // フォローデータをデータベースに登録
            Follow::create([
                'following_id' => $loggedInUserId,//自分のIDを登録する。
                'followed_id' => $followedUserId,//フォローする相手のIDを登録する。
            ]);
            return redirect('/search'); // フォロー後に元のページにリダイレクト
        }
    }
}
