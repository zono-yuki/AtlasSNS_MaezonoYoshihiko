<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Http\Requests\RegisterFormRequest;
//RegisterFormRequestファイルを作ったのでuseで使えるようにする。

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
///////////////////////////////////////////////////////////////////////////////////////////

    public function registerView(Request $request){
    //追加 新規登録画面を表示する。
        return view('auth.register');
        $validated = $request->validated();
    }


    public function register(RegisterFormRequest $request)
    {//変更。
        if ($request->isMethod('post')) {
            //リクエストを受け取る。リクエストに内容が入っていたら、ここに入る。postで来ていたらtrueになる。
            //isMethodとは、指定したHTTP動詞（postやget）があっていたらtrueを返す。

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
            //ここまでがpostの場合の処理
        }

        //リクエストがなかったら（最初は）こっちにくる。新規登録用のviewページを表示する。入力させる画面。
        //ここがgetの場合の処理。registerViewメソッドを作ったのでとりあえず、コメントアウト
        // return view('auth.register');

        $validated = $request->validated();
    }

    public function added()
    {
        return view('auth.added');
    }



    //変更前
    // public function register(Request $request){
    //     if($request->isMethod('post')){
    //         //リクエストを受け取る。リクエストに内容が入っていたら、ここに入る。

    //         $username = $request->input('username');
    //         $mail = $request->input('mail');
    //         $password = $request->input('password');
    //         //受け取ったものを変数にはめていく処理

    //         User::create([
    //             'username' => $username,
    //             'mail' => $mail,
    //             'password' => bcrypt($password),
    //         ]);
    //         //変数をデータベースのカラムに登録していく処理

    //         return redirect('added');
    //         //登録した後、addedのページにアクセスする処理
    //     }
    //     //リクエストがなかったら（最初は）こっちにくる。新規登録画面を表示する。入力させる画面。
    //     return view('auth.register');
    // }

    // public function added(){
    //     return view('auth.added');
    // }
}
