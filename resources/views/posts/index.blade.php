@extends('layouts.login')

@section('content')


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
<input type="image" src="images/post.png" class="submit_btn" alt="送信する">
<!--input要素のtype属性の値にimageを指定すると、画像ボタンを作成することができる。画像ボタンにはalt属性が必須になります。 -->

{!! Form::close() !!}

<!-- 追加  つぶやきを全部表示する処理 -->
@foreach($posts as $post)
<ul>
   <!-- id -->
   <li> {{ $post-> id }}</li>

   <!-- 投稿 -->
   <li> {{ $post-> post }} </li>

   <!-- 作成日時 -->
   <li>{{ $post-> created_at}}</li>

   <!-- 編集ボタン-->
   <li>
      <!-- 編集ボタン押すとモーダル着火-->
      <a href="/post/{{ $post->id }}/update-form">
         <input type="image" src="images/edit.png" class="post_btn1" alt="編集ボタン">
      </a>
   </li>

   <!--削除ボタン-->
   <li>
      <a href="/post/{{ $post->id }}/delete">
         <input type="image" src="images/trash.png" class="post_btn2" alt="削除ボタン"
         onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
      </a>
   </li>


   <br>
</ul>
@endforeach


@endsection
