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


<!-- 投稿を入力するところ -->
{!! Form::open(['url' => '/create']) !!}

<div class="flex-post">
   <img src="{{ asset('storage/images/'.$user->images)}}">
   <label for="comment"></label>
   <textarea id="comment" name="post" cols="100" rows="3" placeholder="投稿内容を入力してください。"></textarea>
   <input type="image" src="{{ asset('storage/images/post.png') }}" class="submit_btn" alt="送信する">
   <!--input要素のtype属性の値にimageを指定すると、画像ボタンを作成することができる。画像ボタンにはalt属性が必須になります。 -->
</div>


{!! Form::close() !!}

<div class="gray-line"></div>

<!-- 追加  つぶやきを全部表示する処理 -->
@foreach($posts as $post)
<div>
   <ul>
      <li class="post-block">
         <figure>
            <a href="/profile/{{ $post->user->id}}/view">
               <img class="top-img" src="{{ asset('storage/images/'.$post-> user ->images)}}" alt="アイコン">
            </a>
         </figure>

         <div class="post-content">
            <div>
               <div class="post-name">
                  {{ $post-> user ->username }}
                  <!-- ユーザー名はpostsテーブルとusersテーブルをリレーションで紐づけてから持ってくる？ -->
               </div>
               <div>
                  {{ $post-> updated_at }}
               </div>
            </div>
            <div>
               {{ $post-> post }}
            </div>
            <ul class="button-flex">
               <!-- 編集ボタン-->
               <li>
                  <!-- 編集ボタン押すとモーダル着火-->
                  <button type="button" class="openModal" post="{{ $post->post }}" post_id="{{ $post ->id}}" updated_at="">
                     <input type="image" src="{{ asset('storage/images/edit.png')}}" class="post_btn1" alt="編集ボタン">
                  </button>
               </li>

               <!--削除ボタン-->
               <li class="trash-box">
                  <a href="/post/{{ $post->id }}/delete">
                     <input type="image" src="{{ asset('storage/images/trash.png')}}" class="post_btn2" alt="削除ボタン" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">

                     <!-- <input type="image" src="{{ asset('storage/images/trash-h.png')}}" class="post_btn2"
                     alt="削除ボタン" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"> -->
                  </a>
               </li>
            </ul>

         </div>
      </li>
   </ul>
</div>
@endforeach





<!--  ///////////////////////////-->

<!-- /////////////////////////// -->

<!-- formを作る、ルート、コントローラーまで完成済み -->
<div id="myModal" class="modal">
   <div class="modal-content">
      <!-- 閉じるボタン -->
      <span id="closeModal">閉じる</span>

      <!-- モーダルエリア -->
      {!! Form::open(['url' => '/post/{id}/update']) !!}
      <!-- 追加 -->
      <!-- jsでこのupdate_idに$post->idのvalueが入っている。 -->
      <input type="hidden" name="id" value="" id="update_id">
      <textarea class="modal-text" name="post" id="textarea_id" value="" cols="50" rows="10">{{$post->post}}</textarea>
      <!-- ↑ここにもともとの入れたい。 -->

      <!-- 更新ボタン -->
      <button id="openModal">
         <input type="image" src="images/edit.png" class="post_btn1" alt="更新ボタン">
      </button>

      {!! Form::close() !!}


   </div>
</div>
@endsection
