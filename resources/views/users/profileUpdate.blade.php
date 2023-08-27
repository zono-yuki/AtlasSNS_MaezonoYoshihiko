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

           <!-- <input type="file" id="fileElem" multiple style="display:none" />
           <button id="fileSelect" type="button">
            ファイルを選択
           </button> -->

           <div id="app">
            <label class="file-label">
             <input type="file" name="file">ファイルを選択
            </label>
           </div>



       </div>

     </div>


    </div>

    <!-- 送信ボタン -->
    <div class="btn-update">
     <button type="submit" class="btn btn-update_color">更新</button>
    </div>


  {!! Form::close() !!}

@endsection
