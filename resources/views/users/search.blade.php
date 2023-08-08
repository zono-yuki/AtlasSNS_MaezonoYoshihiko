@extends('layouts.login')

@section('content')

<!-- 今日は、Redmine質問作成と、フォームのcss、検索処理の実装をする。 -->
<!-- @csrfはpostで送る時に書かないとエラーになるから書く。笑トークンが勝手に含まれて送られる。セッションにも入るのでそれと一致し、一致した場合の正規のリクエストとして受け入れられる仕様になる -->
<!-- これが送られる。クロスサイトリクエストフォージェリを防ぐため。不正なHTTPを送られる攻撃。
    <input type="hidden" name="_token" value="loiuhJKkjhUI664hjgk6jhg6fjg675JHGGOogo">
 -->

 <!-- ユーザー検索フォーム表示-->
<div>
  <form action="/search/" method="post" class="search-form-001">
    @csrf
    <input type="search" name="keyword" class="form" placeholder="ユーザー名" value="@if(isset($keyword)){{$keyword}}@endif">
    <input type="image" src="images/search.png" class="search_btn" alt="検索ボタン"></input>
  </form>
</div>

@if(!empty($keyword))
<p>検索ワード：{{$keyword}}</p>
@endif
@endsection
