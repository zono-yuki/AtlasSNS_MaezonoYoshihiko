@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

<!-- <div class="content_wrapper">
  <div class="content2"> -->

    {!! Form::open(['url' => '/create']) !!}
     <label for="comment"></label>
     <textarea id="comment" name="post" cols="100" rows="5" placeholder="投稿内容を入力してください。"></textarea>
     <input type="submit" class="submitbtn">

    {!! Form::close() !!}
  <!-- </div>
</div> -->

@endsection
