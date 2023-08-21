@extends('layouts.login')

@section('content')
<!-- フォローしている人のアイコン一覧 -->
<div class="follow-list">

  <!-- タイトル -->
  <h2 class="list-title">Follower List</h2>

  <!-- $followsはフォローしている人を全部コントローラーから取得して持ってきている -->
  @foreach ($followers as $follower)
  <div>
    <!-- アイコンひとまとめ -->
    <figure class="follow_icon">
      <img src="{{ asset('storage/images/icon1.png')}} " alt=" フォローアイコン">
      <!-- <img src="{r{ asset('storage/images/' .$post->user->images)}} " alt=" フォローアイコン"> -->


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
