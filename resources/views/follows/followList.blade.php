@extends('layouts.login')

@section('content')
<!-- フォローしている人のアイコン一覧 -->
<div class="follow-list">

  <!-- タイトル -->
  <h2 class="list-title">Follow List</h2>

  <!-- $followsはフォローしている人を全部コントローラーから取得して持ってきている -->

  <!-- アイコンが多くなったら折り返して表示する。 -->
  <div class="max-row">
    @foreach ($follows as $follow)
    <div class="max-row">
      <!-- アイコンひとまとめ -->
      <figure class="follow_icon">
        <a href="/profile/{{ $follow->id}}/view">
          @if($follow -> images == 'icon1.png' )
          <li class="header-icon"><img src="{{ asset('images/'.$follow->images) }}"></li>
          <!-- public/images -->
          @else
          <li class="header-icon"><img src="{{ asset('storage/images/'.$follow ->images) }}"></li>
          @endif
        </a>
      </figure>
    </div>
    @endforeach
  </div>
</div>

<div class="gray-line"></div>

@foreach($posts as $post)
<div>
  <ul>
    <li class="post-block">

      <!-- アイコン表示 -->


      @if($post->user-> images == 'icon1.png' )
      <figure>
        <a href="/profile/{{ $post->user->id}}/view">
          <img class="top-img" src="{{ asset('images/'.$post->user->images)}}" alt="アイコン">
        </a>
      </figure>
      @else
      <!-- icon1でなければ、 -->
      <figure>
        <a href="/profile/{{ $post->user->id}}/view">
          <img class="top-img" src="{{ asset('storage/images/'.$post->user->images)}}" alt="アイコン">
        </a>
      </figure>
      @endif

      <!-- 投稿表示 -->
      <div class="post-content">
        <div>
          <div class="post-name">
            {{ $post->user->username}}
          </div>
          <div>
            {{ date("Y-m-d H:i",strtotime($post->updated_at))}}
          </div>
        </div>
        <div>
          {!! nl2br($post-> post) !!}
        </div>
      </div>

    </li>

  </ul>

</div>
@endforeach
@endsection
