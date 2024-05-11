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
        //ログインユーザーがフォローしているレコードを全部取得する、①これをviewに送る。
        $follows = Auth::user()->follows()->get();

        //フォローしている人のidを取得する。（pluck）
        $following_id = Auth::user()->follows()->pluck('followed_id');

        //自分がフォーローしているユーザーの投稿を新しい順（降順）で全部取得する。
        //②これをviewに送る
        $posts = Post::with('user')->whereIn('user_id',$following_id)->latest('updated_at')->get();
        //フォローリストを表示する。
        return view('follows.followList', ['posts' => $posts, 'follows' => $follows]);
    }

    public function followerList(){
        //フォローワーリストの画面を表示する。フォローされている人のアイコンと、投稿を表示する。
        // まず、中間テーブルから自分をフォローしてくれているレコードを全部抽出する。（①アイコンの表示で使います。）
        $followers = Auth::user()->follower()->get();
        // dd($followers);
        //自分をフォローしてくれている人（フォロワーさん）のidを取り出す。
        $followering_id = Auth::user()->follower()->pluck('following_id');

        // dd($followering_id);
        //取得できている。

        // フォロワーさんの投稿を取得する。Postモデル(postsテーブル)からpostsテーブルのuser_idと$followering_idが同じ投稿を新しい順で取得する。
        // ②これをviewに送る
        $posts = Post::with('user')->whereIn('user_id', $followering_id)->latest('updated_at')->get();
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
                ->delete();//削除
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
            Follow::create([//登録
                'following_id' => $loggedInUserId,//自分のIDを登録する。
                'followed_id' => $followedUserId,//フォローする相手のIDを登録する。
            ]);
            return redirect('/search'); // フォロー後に元のページにリダイレクト
        }
    }
}
