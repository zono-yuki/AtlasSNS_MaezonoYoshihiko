<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Follow;
use App\Http\Requests\UserFormRequest;//UserFormRequestファイルを作ったのでバリデーション処理を使えるようにする。


class UsersController extends Controller
{
    //自分のプロフィール編集画面を表示する処理
    public function profileupdate(Request $request){
        return view('users.profileUpdate');
    }

    //自分のプロフィールを更新する処理
    public function update(UserFormRequest $request)
    {
        $id = auth()->user()->id;
        $upUsername = $request->input('username');
        $upMail = $request->input('mail');
        $upPassword = $request->input('password');
        $upBio = $request->input('bio');
        // $upImages = $request->file('icon_image')->update('public/storage/images/');
        // $filename = $request->image->getClientOringin;


    //画像が入力されていた場合のみ更新
        if($request->filled('icon_image')){
            $file = $request->file('icon_image')->store('public')->getClientOriginalName();
            $path = Storage::url($file); //画像のパスを生成
            $images = $path;
        }

        User::where('id', $id)->update([
            'username' => $upUsername,
            'mail' => $upMail,
            'password' => bcrypt($upPassword),
            'bio' => $upBio,
            // 'images' => $images,
        ]);

        return redirect('/top');
    }

    //他ユーザーのプロフィール画面を表示させる処理
    public function profile(Int $user_Id){

        //リンク元のidを元にユーザー情報を取得する
        $users = User::where('id', $user_Id)->first();
        // dd($users);
        //リンク元ユーザーのidを元に投稿内容を取得する
        $posts = Post::with('user')->Where('user_id', $user_Id)->latest()->get();
        // dd($posts);


        return view('users.profile',compact('users','posts'));
    }

    // フォローを解除する（相手プロフィール画面でのフォロー解除ボタン）

    //フォロー解除ボタン///////
        public function unfollow(Int $user_Id) //$userIdは相手のid
        {
            // dd($user_Id);

            // フォローしているか
            $follower = auth()->user();
            // dd($follower);

            $is_following = $follower->isFollowing($user_Id); //相手のidを飛ばして登録しているか確認する

            // フォローしていれば下記のフォロー解除を実行する
            if ($is_following) {

                $loggedInUserId = auth()->user()->id; //自分のIDを取得
                // フォローしたい人のユーザーIDを元にユーザーを取得
                $followedUser = User::find($user_Id); //ユーザーテーブルからその相手の情報を全部入れる。
                $followedUserId = $followedUser->id; //その情報からidを取得する。

                Follow::where([ //中間テーブルの中を探す
                    ['following_id', '=', $loggedInUserId], //自分のID
                    ['followed_id', '=', $followedUserId], //自分がフォローしている相手のID
                ])
                    ->delete();
            }

            return redirect(route('profile.index',[//profileページの再読み込み
                'id' => $user_Id ,
            ]));
        }

    //フォローするボタン///////（相手プロフィール画面でのフォローするボタン）$userIdは相手のid
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
        }

        return redirect(route('profile.index', [ //profileページの再読み込み、ルート名入れてそこにidを飛ばす。
            'id' => $user_Id,
        ]));
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
