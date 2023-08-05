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
<tr>
   <td> {{ $post-> id }}</td>
   <td> {{ $post-> post }} </td>
   <td>
      <a href="/post/{{ $post->id}}/update-form">
         <img class="post_btn" src="images/edit.png" alt="編集ボタン"></a>
   </td>
   <td>
      <a href="/post/{{ $post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
         <img class="post_btn" src="images/trash.png" alt="削除ボタン"></a>
   </td>
   <br>
</tr>
@endforeach


@endsection
