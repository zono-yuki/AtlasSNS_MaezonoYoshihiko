<!-- ////////////////////////ログイン画面表示 //////////////////////////////////////-->

@extends('layouts.logout')
<!-- logout.blade.phpに繋がる。 -->

@section('content')
<!-- フォームファザード  適切なURLを入力してください -->
<div class="login-form">
   {!! Form::open(['url' => '/login']) !!}
     <p class="hello">AtlasSNSへようこそ</p>

       <div class="box">

           <div class="set">
             {{ Form::label('e-mail','mail address',['class' => 'login']) }}
              <br>
              {{ Form::text('mail',null,['class' => 'input']) }}
              <br>
           </div>

           <div class="set">
             {{ Form::label('password','password',['class' => 'login'])  }}
              <br>
             {{ Form::password('password',['class' => 'input']) }}
              <br>
           </div>

           {{ Form::submit('LOGIN',['class' => 'login-btn']) }}

           <p class="register"><a href="/register">新規ユーザーの方はこちら</a></p>
      </div>
         {!! Form::close() !!}

</div>


@endsection
