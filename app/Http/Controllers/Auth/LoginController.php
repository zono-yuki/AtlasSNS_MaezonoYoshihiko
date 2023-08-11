<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; //これを追加したらAuth認証できた
use Illuminate\Http\Request;
// use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    //  /loginのURLのとき
    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top');
                //top画面にいく。
            }
        }
        return view("auth.login");
        //リクエストがなかったらもう一度ログイン画面を表示する。
    }

    // ログアウトする処理
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
        //redirectはweb.phpをを通す際に使う。viewはそのままblain.phpを表示する。
        //TOP画面に遷移する
    }
}
