<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            //リクエストを受け取る。リクエストに内容が入っていたら、ここに入る。

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');
            //受け取ったものを変数にはめていく処理

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);
            //変数をデータベースのカラムに登録していく処理

            return redirect('added');
            //登録した後、addedのページにアクセスする処理
        }
        //リクエストがなかったら（最初は）こっちにくる。新規登録画面を表示する。入力させる画面。
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
