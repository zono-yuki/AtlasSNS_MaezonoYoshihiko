@extends('layouts.login')

@section('content')


<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
   <ul>
      @foreach ($errors->all() as $error)
      <li class="error-message">{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif


<!-- 投稿を入力するところ -->
{!! Form::open(['url' => '/create']) !!}

<div class="flex-post">

<!-- アイコン -->
   @if($user -> images == 'icon1.png' )
   <a href="/profile/{{ $user->id}}/view">
      <img src="{{ asset('images/'.$user-> images) }}">
      <!-- public/images もともとあった場所から持ってくる。 -->
   </a>
   @else
   <!-- icon1でなければ、 -->
   <a href="/profile/{{ $user->id}}/view">
      <img src=" {{ asset('storage/images/'.$user->images)}}">
   </a>
   @endif

   <label for="comment"></label>
   <textarea id="comment" name="post" cols="100" rows="3" placeholder="投稿内容を入力してください。"></textarea>
   <input type="image" src="{{ asset('images/post.png') }}" class="submit_btn" alt="送信する">
   <!--input要素のtype属性の値にimageを指定すると、画像ボタンを作成することができる。画像ボタンにはalt属性が必須になります。 -->
</div>


{!! Form::close() !!}

<div class="gray-line-top"></div>

<!-- 追加  つぶやきを全部表示する処理 -->
@foreach($posts as $post)
<div>
   <ul>
      <li class="post-block">

         <!-- アイコン -->
         @if( $post->user->images == 'icon1.png' )
         <figure>
            <a href="/profile/{{ $post->user->id}}/view">
               <img class="top-img" src="{{ asset('images/'.$post-> user ->images)}}" alt="アイコン">
            </a>
         </figure>
         @else
         <!-- icon1でなければ、 -->
         <figure>
            <a href="/profile/{{ $post->user->id}}/view">
               <img class="top-img" src="{{ asset('storage/images/'.$post-> user ->images)}}" alt="アイコン">
            </a>
         </figure>
         @endif

         <div class="post-content">
            <div>
               <div class="post-name">
                  {{ $post-> user ->username }}
                  <!-- ユーザー名はpostsテーブルとusersテーブルをリレーションで紐づけてから持ってくる？ -->
               </div>
               <div>
                  <!-- 秒数消す -->
                  {{ date("Y-m-d H:i",strtotime($post->updated_at))}}
               </div>
            </div>
            <div>
               {!! nl2br($post-> post) !!}
            </div>

            @if($post->user->id === $user->id)
            <ul class="button-flex">
               <!-- 編集ボタン-->
               <li>
                  <!-- 編集ボタン押すとモーダル着火-->
                  <button type="button" class="openModal" post="{{ $post->post }}" post_id="{{ $post ->id}}" updated_at="">
                     <input type="image" src="{{ asset('images/edit.png')}}" class="post_btn1" alt="編集ボタン">
                  </button>
               </li>

               <!--削除ボタン-->
               <li class="trash-box">
                  <a href="/post/{{ $post->id }}/delete">
                     <input type="image" src="{{ asset('images/trash.png')}}" class="post_btn2" alt="削除ボタン" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">

                     <!-- <input type="image" src="{{ asset('storage/images/trash-h.png')}}" class="post_btn2"
                     alt="削除ボタン" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"> -->
                  </a>
               </li>
            </ul>
            @endif

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
      <textarea class="modal-text" name="post" id="textarea_id" value="" cols="50" rows="10"></textarea>
      <!-- ↑ここにもともとの入れたい。 -->

      <!-- 更新ボタン -->
      <button id="openModal">
         <input type="image" src="{{asset('images/edit.png')}}" class="post_btn1" alt="更新ボタン">
      </button>

      {!! Form::close() !!}


   </div>
</div>
@endsection
