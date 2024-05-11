@extends('layouts.login')

@section('content')


<!-- ユーザー検索フォーム表示-->


<div class="search-top-flex">
  <div>
    <!-- 検索フォーム -->
    <form action="/search" method="post" class="search-form-001">
      @csrf
      <input type="search" name="keyword" class="form" placeholder="ユーザー名" value="@if(isset($keyword)){{ $keyword }}@endif">
      <!-- もしキーワードが入力されていたら、キーワードを表示する。前の検索を残すため。 -->
      <input type="image" src="{{ asset('images/search.png') }}" class="search_btn" alt="検索ボタン"></input>
      <!-- 検索ボタン -->
    </form>
  </div>

  <!-- 検索ワードの表示 -->
  <!-- 検索ワードに入力していた場合、検索ワードを表示する -->
  <div class="keyword-box">
    @if(!empty($keyword))
    <p class="keyword">検索ワード：{{$keyword}}</p>
    @endif
  </div>
</div>

<div class="gray-line"></div>

<!-- 保存されているユーザー一覧 -->
<div class="container-list">

  <!-- UsersControllerから飛んでくる。$usersは送られてきた検索に一致したユーザー -->
  <!-- 名前が少しでも一致したusers情報をあるだけ全て繰り返す-->
  <!-- 自分以外のユーザー情報usersをひとまとめに表示する -->

  @foreach($users as $users)

  <!-- ログインユーザー以外を表示する-->
  @if(!($user-> username == $users->username))

  <ul class="search-users">

    <!-- 登録者アイコン -->
    @if($users -> images == 'icon1.png' )
    <li class="search-icon">
      <a href="/profile/{{ $users->id}}/view">
        <img src="{{ asset('images/'.$users->images) }}" alt="ユーザーアイコン">
      </a>
    </li>
    @else
    <!-- icon1でなければ、 -->
    <li class="search-icon">
      <a href="/profile/{{ $users->id}}/view">
        <img src="{{ asset('storage/images/'.$users->images) }}" alt="ユーザーアイコン">
      </a>
    </li>
    @endif


    <!-- 登録者名 -->
    <li class="search-name">{{$users->username}}</li>


    <!-- フォロー、フォロー解除ボタン -->

    <!-- もしログインユーザーがフォローしていたらフォロー解除ボタンを表示する -->
    <!-- isFollowingメソッドにフォローしているか判定-->
    <!--相手のidをフォローしているか確認するために、送る-->
    @if (auth()->user()->isFollowing($users->id))
    <li class="unfollow_btn">
      <button type="submit" class="btn unfollow">
        <a href="/search/{{ $users->id }}/unfollow">フォロー解除</a>
      </button>
    </li>

    <!-- フォローしていなかったらフォローボタンを表示する -->
    @else
    <li class="follow_btn">
      <button type="submit" class="btn follow">
        <a href="/search/{{ $users->id }}/follow">フォローする</a>
      </button>
    </li>
    @endif

  </ul>
  @endif
  @endforeach
</div>
@endsection
