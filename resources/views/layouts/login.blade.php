<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="{{ asset('images/icon4.png') }}" sizes="16x16" type="image/png" />
    <link rel="icon" href="{{ asset('images/icon5.png') }}" sizes="32x32" type="image/png" />
    <link rel="icon" href="{{ asset('images/icon6.png') }}" sizes="48x48" type="image/png" />
    <link rel="icon" href="{{ asset('images/icon7.png') }}" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

    <!-- javascript 追加！！！-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>
    <header>
        <!-- Atlasアイコン -->
        <p class="logo">
            <a href="/top">
                <img src="{{ asset('images/atlas.png') }}">
            </a>
        </p>



        <ul class="top">
            <php?
              $user = $_GET[];


            ?>
            <li> {{ $user -> username}} さん</li>

            <li>
                <div id="accordion" class="accordion-container">

                    <h4 class="accordion-title js-accordion-title">MENU</h4>
                    <div class="accordion-content">
                        <p><a href="{{ asset('/top') }}">HOME</a></p>
                        <p><a href="{{ asset('/profile') }}">プロフィール編集</a></p>
                        <p><a href="{{ asset('/logout') }}">ログアウト</a></p>
                    </div>

                </div>
            </li>


            <li><img src="{{ asset('images/icon1.png') }}"></li>

        </ul>
    </header>





    <div id="row">

     <!-- 左側 -->
        <div id="container">
            @yield('content')
            <!-- ここの中身だけindex.php、followlist.php、followerlist.phpでは継承して使う。 -->
        </div>


    <!-- 右側 -->
        <div id="side-bar">
            <div id="confirm">
                <p> {{$user->username }} さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="{{ asset('/followList') }}">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="{{ asset('/followerList') }}">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="{{ asset('/search') }}">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src=" {{ asset('js/script.js') }}"></script>
</body>

</html>
