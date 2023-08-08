@extends('layouts.login')

@section('content')

<!-- 今日は、Redmine質問作成と、フォームのcss、検索処理の実装をする。 -->
<!-- @csrfはpostで送る時に書かないとエラーになるから書く。笑トークンが勝手に含まれて送られる。セッションにも入るのでそれと一致し、一致した場合の正規のリクエストとして受け入れられる仕様になる -->
<!-- これが送られる。クロスサイトリクエストフォージェリを防ぐため。不正なHTTPを送られる攻撃。
    <input type="hidden" name="_token" value="loiuhJKkjhUI664hjgk6jhg6fjg675JHGGOogo">
 -->
<div>
  <form action="/search" method="post" class="search-form-001">
    @csrf
    <input type="text" name="keyword" class="form" placeholder="ユーザー名">
    <input type="image" src="images/search.png" class="search_btn" alt="検索ボタン"></input>
    <!-- <input type="image" src="images/edit.png" class="post_btn1" alt="編集ボタン"> -->
  </form>
</div>
@endsection
