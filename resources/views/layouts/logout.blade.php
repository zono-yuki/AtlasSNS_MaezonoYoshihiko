<!-- 最初のログイン画面の表示-->
<!-- このファイルにlogin.blade.phpの中身が入る感じ -->


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ログインページ" />
  <title>アトラスログイン</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!--サイトのアイコン指定-->
  <link rel="icon" href="{{ asset('images/icon1.png') }}" sizes="16x16" type="image/png" />
  <link rel="icon" href="{{ asset('images/icon2.png') }}" sizes="32x32" type="image/png" />
  <link rel="icon" href="{{ asset('images/icon3.png') }}" sizes="48x48" type="image/png" />
  <link rel="icon" href="{{ asset('images/icon4.png') }}" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>

    <header>
      <h1><img src="{{ asset('storage/images/atlas.png') }}"></h1>
      <p>Social Network Service</p>
    </header>

    <div id="container">
      @yield('content')
    </div>
    <!-- ここにlogin.blade.phpのデータが入る。-->


  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
