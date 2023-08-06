<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//////////////////////////////////////////////////////

//ログアウト中のページ///////////////////////////////////

//ログイン画面の表示
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');


//新規ユーザー登録画面を表示する
Route::get('/register', 'Auth\RegisterController@registerView'); //新規登録画面の表示
Route::post('/register', 'Auth\RegisterController@register');//入力したデータをpostでうけとるところ。


//登録を完了した画面を表示する
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログアウトをする処理
Route::get('/logout', 'Auth\LoginController@logout');





/////////////////////////////////////////////////////////////////////


//////////////////////ログイン中のページ//////////////////////////////////

Route::group(['middleware' => 'auth'], function (){ //アクセス制限をかける

 //トップページ画面
   Route::get('/top','PostsController@index');//投稿画面とつぶやき表示まで表示する。
   Route::post('/create', 'PostsController@create'); //投稿ボタンを押した時、登録する処理。

   //追加
  //  Route::get('/post/{{ $post->id}}/update-form', '');




 //プロフィール画面
   Route::get('/profile','UsersController@profile');

 //ユーザー検索画面
   Route::get('/search','UsersController@search');

 //フォローリスト画面
   Route::get('/followList','PostsController@followList');

 //フォロワーリスト画面
   Route::get('/followerList','PostsController@followerList');

});
