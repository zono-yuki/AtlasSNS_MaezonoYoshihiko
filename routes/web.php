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
Route::get('/register', 'Auth\RegisterController@registerView'); //ルーティング変更 @registerから@registerViewに変更しています。1番最初の新規ユーザー画面を表示するところ。
Route::post('/register', 'Auth\RegisterController@register');//入力したデータをpostでうけとるところ。


//登録を完了した画面を表示する
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログアウトをする処理
Route::get('/logout', 'Auth\LoginController@logout');





///////////////////////////////////////////////////////


//ログイン中のページ
Route::get('/top','PostsController@index');
//追加/////////最初に追加    post/top//////////////////////////////////////////////////////
Route::post('/top','PostsController@index');



Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');
