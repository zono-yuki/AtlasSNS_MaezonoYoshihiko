@extends('layouts.login')

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif

<!-- プロフィール編集の入力フォーム -->
  <!-- {!! Form ::open(['url' => '/profile/update']) !!} -->

  <form class="" action="{{ url('/user/profile/update') }}" method="POST" enctype="multipart/form-data">
   @csrf
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
         <input type="text" class="items-input" name="username" value = "{{ auth()->user()->username}}">
       </div>


       <div class="profile-items">
         <p>mail adress</p>
         <input  type="email" class="items-input" name="mail" value = "{{ auth()->user()->mail }}">
       </div>


       <div class="profile-items">
        <p>password</p>
        <input type="password" class="items-input" name="password">
       </div>

       <div class="profile-items">
         <p>password confirm</p>
         <input type="password" class="items-input" name="password_confirmation">
       </div>

       <div class="profile-items">
         <p>bio</p>
         <input type="text" class="items-input" name="bio" value = "{{ auth()->user()->bio }}">
       </div>

       <div class="profile-items">
         <p>icon image</p>
           <div id="app">
            <label class="file-label">
             <input type="file" name="icon_image">ファイルを選択
            </label>
           </div>
        </div>

     </div>
    </div>

    <!-- 送信ボタン -->
    <div class="btn-update">
     <button type="submit" class="btn btn-update_color">更新</button>
    </div>
  </form>

@endsection
