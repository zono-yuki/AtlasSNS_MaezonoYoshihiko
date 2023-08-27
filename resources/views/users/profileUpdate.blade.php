@extends('layouts.login')

@section('content')

<!-- プロフィール編集の入力フォーム -->
  {!! Form ::open(['url' => '/profile/update']) !!}
    <div class="form-group">

    <!-- アイコンボックス -->
     <figure class="profile_icon">
          <a href="/profile/{{ auth()->user()->id}}/view">
            <img class="top-img" src="{{ asset('storage/images/'. auth()-> user() ->images)}}" alt="アイコン">
          </a>
     </figure>


    <!--  プロフィールボックス -->
     <div class="profile-item">

       <div class="profile-items">
         <p>user name</p>
         <input type="text" class="items-input" name="name" value = "{{ auth()->user()->username}}">
       </div>


       <div class="profile-items">
         <p>mail adress</p>
         <input  type="email" class="items-input" name="name" value = "{{ auth()->user()->mail }}">
       </div>


       <div class="profile-items">
        <p>password</p>
        <input type="password" class="items-input" name="name">
       </div>

       <div class="profile-items">
         <p>password confirm</p>
         <input type="password" class="items-input" name="name">
       </div>

       <div class="profile-items">
         <p>bio</p>
         <input type="text" class="items-input" name="name" , value = "{{ auth()->user()->bio }}">
       </div>

       <div class="profile-items">
         <p>icon image</p>
         <input type="file" class="items-input" name="name" ,null>
       </div>

     </div>


    </div>

    <!-- 送信ボタン -->
    <button type="submit" class="btn btn-success pull-right">更新</button>

  {!! Form::close() !!}

@endsection
