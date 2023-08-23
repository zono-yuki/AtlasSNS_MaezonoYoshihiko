@extends('layouts.login')

@section('content')

<div>
  <div class="icon-flex">
    <!-- $usersは、、アイコンユーザーのユーザー情報(UsersController@profileで取ってきている) -->
    <!--  アイコン、ユーザー名、自己紹介文を画面に表示する-->

    <!-- アイコン表示 とりあえず、icon1.pngを表示-->

    <figure>
      <img class="top-img" src="{{ asset('storage/images/icon2.png')}}" alt="アイコン">
    </figure>
    <!-- <p>{{ $users->images }}</p> -->

    <div class="content-flex">
      <div class="name-flex">
        <div class="name1">name</div>
        <div class="user-name">{{ $users->username }}</div>
      </div>

      <div class="bio-flex">
        <div class="bio-title">bio</div>
        <div class="bio-post">SNSシステムを作成しています。</div>
        <!-- <div>{{ $users-> bio}}</div> -->
        <!-- 入力できるようになると表示される -->
      </div>


    </div>

    <!-- ログインユーザーでなければ「フォローする」or「フォロー解除」ボタンを表示する -->
    <div class="btn_box">
      @if(!(Auth::user()== $users ))
        @if(Auth()->user()->isFollowing($users->id))
          <div class="unfollow_btn">
            <button type="submit" class="btn_profile unfollow">
              <a href="/profile/{{ $users->id }}/unfollow">フォロー解除</a>
            </button>
          </div>
        @else
          <div class="follow_btn">
            <button type="submit" class="btn_profile follow">
              <a href="/profile/{{ $users->id }}/follow">フォローする</a>
            </button>
          </div>
        @endif
      @endif
    </div>






  </div>

  <div class="gray-line"></div>


</div>

@endsection
