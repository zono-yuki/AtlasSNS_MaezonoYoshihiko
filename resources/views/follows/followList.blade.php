@extends('layouts.login')

@section('content')
<!-- フォローしている人のアイコン一覧 -->
<div class="follow-list">

<!-- タイトル -->
  <h2>Follow List</h2>

  <!-- $followsはフォローしている人を全部コントローラーから取得して持ってきている -->
  @foreach ($follows as $follow)
  dd($follows)
  <ul>
    <li>
      <!-- アイコンひとまとめ -->
      <figure class="follow_icon">
        <img src=" asset('storage/images/'.$follow->images)" alt="フォローアイコン">
      </figure>
    </li>
 </ul>
  @endforeach
</div>
@endsection
