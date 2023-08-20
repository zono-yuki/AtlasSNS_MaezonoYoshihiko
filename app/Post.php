<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'user_id','post' //外部キーを設定
    ];

    //リレーション
    //1対多の1側なので単数系
    public function user(){
        return $this -> belongsTo(User::class);
    }
}
