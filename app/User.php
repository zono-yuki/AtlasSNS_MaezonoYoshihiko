<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Follow;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','bio'//外部キーを設定
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'following_id' , 'followed_id',
    ];

/////////////////////////////////////////////////////////////////////////////////////////
    // 一人のユーザーが複数の投稿を持つリレーション、一対多の関係
    public function posts()
    {
        return $this->hasMany('Post::class');
    }
///////////////////////////////////////////////////////////////////////////////////////
    //多対多のリレーションを書く。
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    public function follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

////////////////////////////////////////////////////////////////////////////////////
    // $user_Idさんをフォローしているか確認する
    public function isFollowing(Int $user_Id)
    {
        return (bool) $this->follows()->where('followed_id', $user_Id)->first();
        // ログインユーザーがフォローしているユーザーさんを探す。
    }

    //フォローされているか確認する
    public function isFollowed(Int $user_Id)
    {
        return (bool) $this->follower()->where('following_id', $user_Id)->first();
    }

//////////////////////////使用していない
/////////////////////////////////////////////////////////
    //フォローする
    public function follow(Int $user_Id)
    {
        return $this->follows()->attach($user_Id);
    }
    //フォロー解除する
    public function unfollow(Int $user_Id)
    {
        return $this->follows()->detach($user_Id);
    }
///////////////////////////////////////////////////////////////////////////////////////////

}
