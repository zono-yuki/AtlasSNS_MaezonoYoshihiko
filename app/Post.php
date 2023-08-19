<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'user_id', //外部キーを設定
    ];

    //リレーション
    public function user(){
        return $this -> belongsTo(User::class);
    }
}
