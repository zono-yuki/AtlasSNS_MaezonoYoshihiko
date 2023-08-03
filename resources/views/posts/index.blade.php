@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

<!-- <div class="content_wrapper">
  <div class="content2"> -->
<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
   <ul>
      @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif

{!! Form::open(['url' => '/create']) !!}
<label for="comment"></label>
<textarea id="comment" name="post" cols="100" rows="5" placeholder="投稿内容を入力してください。"></textarea>
<input type="image" src="images/post.png"  class="submit_btn" alt="送信する">
<!--input要素のtype属性の値にimageを指定すると、画像ボタンを作成することができる。画像ボタンにはalt属性が必須になります。 -->

{!! Form::close() !!}
<!-- </div>
</div> -->

@endsection
