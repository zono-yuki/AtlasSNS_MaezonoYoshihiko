@extends('layouts.login')

@section('content')
<!-- フォローしている人のアイコン一覧 -->
<div class="follow-list">

  <!-- タイトル -->
  <h2 class="list-title">Follow List</h2>

  <!-- $followsはフォローしている人を全部コントローラーから取得して持ってきている -->
  @foreach ($follows as $follow)
  <div>
    <!-- アイコンひとまとめ -->
    <figure class="follow_icon">
      <a href="/profile/{{ $follow->id}}/view">
        <img src="{{ asset('storage/images/icon1.png')}} " alt=" フォローアイコン">
      </a>


    </figure>
  </div>
  @endforeach
</div>

<div class="gray-line"></div>

@foreach($posts as $post)
<div>
  <ul>
    <li class="post-block">

      <!-- アイコン表示 -->
      <figure>
        <a href="/profile/{{ $post->user->id}}/view">
          <img class="top-img" src="{{ asset('storage/images/icon1.png')}}" alt="アイコン">
        </a>

      </figure>


      <!-- 投稿表示 -->
      <div class="post-content">
        <div>
          <div class="post-name">
            {{ $post->user->username}}
          </div>
          <div>
            {{ $post->updated_at}}
          </div>
        </div>
        <div>
          {{ $post->post }}
        </div>
      </div>

    </li>

  </ul>

</div>
@endforeach
@endsection
