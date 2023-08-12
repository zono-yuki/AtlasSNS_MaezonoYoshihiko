@extends('layouts.login')

@section('content')

<!-- 今日は、Redmine質問作成と、フォームのcss、検索処理の実装をする。 -->
<!-- @csrfはpostで送る時に書かないとエラーになるから書く。笑トークンが勝手に含まれて送られる。セッションにも入るのでそれと一致し、一致した場合の正規のリクエストとして受け入れられる仕様になる -->
<!-- これが送られる。クロスサイトリクエストフォージェリを防ぐため。不正なHTTPを送られる攻撃。
    <input type="hidden" name="_token" value="loiuhJKkjhUI664hjgk6jhg6fjg675JHGGOogo">
 -->

 <!-- ユーザー検索フォーム表示-->
<div>
  <form action="/search" method="post" class="search-form-001">
    @csrf
    <input type="search" name="keyword" class="form" placeholder="ユーザー名" value="@if(isset($keyword)) {{ $keyword }}@endif">
    <input type="image" src="images/search.png" class="search_btn" alt="検索ボタン"></input>
  </form>
</div>

<!-- 検索ワードの表示 -->
@if(!empty($keyword))
<p>検索ワード：{{$keyword}}</p>
@endif


<!-- 保存されているユーザー一覧 -->
<div class="container-list">
  <table class="table table-hover">
    @foreach($users as $users)

    <!-- 自分以外のユーザーを表示 -->
      @if(!($user-> username == $users->username))
      <tr>
        <td>{{$users->username}}</td>
        <td><img src="{{ $users -> images}}" alt="ユーザーアイコン"></td>
      </tr>
      @endif
    @endforeach
  </table>
</div>
@endsection
