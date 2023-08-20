<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;
use App\Post;


class FollowsController extends Controller
{

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
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
