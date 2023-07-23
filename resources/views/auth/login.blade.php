@extends('layouts.logout')
<!-- logout.blade.phpに繋がる。 -->

@section('content')
<!-- フォームファザード  適切なURLを入力してください -->
{!! Form::open(['url' => '/top']) !!}
<!-- 下の内容の送り先を書く。（/topに飛ばす） -->

<p>AtlasSNSへようこそ</p>

{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input']) }}
<!-- e-mail入力するところ -->
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
<!-- パスワードを入力するところ -->
{{ Form::submit('ログイン') }}
<!-- ログインボタン -->


<p><a href="/register">新規ユーザーの方はこちら</a></p>
<!-- http://127.0.0.1:8000/registerに飛ぶ。-->

{!! Form::close() !!}

@endsection
