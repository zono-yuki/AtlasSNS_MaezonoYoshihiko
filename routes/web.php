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
Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@login');


//新規ユーザー登録画面を表示する
Route::get('/register', 'Auth\RegisterController@registerView'); //新規登録画面の表示する処理
Route::post('/register', 'Auth\RegisterController@register');//入力したデータを受けて登録する処理。


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
   Route::post('/top', 'PostsController@index');

   Route::post('/create', 'PostsController@create'); //投稿を登録する処理。

   Route::get('/post/{id}/delete','PostsController@delete');//投稿の削除
   Route::post('/post/{id}/update','PostsController@update');//投稿の更新 追加




 //プロフィール画面
   Route::get('/profile','UsersController@profile');


 //ユーザー検索画面
   Route::get ('/search','UsersController@search');
   Route::post('/search','UsersController@search');


 //フォローリスト画面
   Route::get('/followList','PostsController@followList');

 //フォロワーリスト画面
   Route::get('/followerList','PostsController@followerList');

});
