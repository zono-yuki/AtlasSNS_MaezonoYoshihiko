@extends('layouts.logout')

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



<!-- 適切なURLを入力してください -->
<!-- {!! Form::open(['url' => '/〇〇']) !!} -->
{!! Form::open(['url' => '/register']) !!}
<!-- /register画面にもう一度飛ばす。次は内容があるのでpostで受け取る。二回目で入力しているので、リクエストを受け取る処理にいく。 -->

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
