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
    <link rel="icon" href="{{ asset('storage/images/icon4.png') }}" sizes="16x16" type="image/png" />
    <link rel="icon" href="{{ asset('storage/images/icon5.png') }}" sizes="32x32" type="image/png" />
    <link rel="icon" href="{{ asset('storage/images/icon6.png') }}" sizes="48x48" type="image/png" />
    <link rel="icon" href="{{ asset('storage/images/icon7.png') }}" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

    <!-- javascript 追加！！！-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>
    <header>
        <!-- Atlasロゴ -->
        <p class="logo">
            <a href="/top">
                <img class="atlas_logo" src="{{ asset('storage/images/atlas.png') }}">
            </a>
        </p>



        <ul class="top">
            <!--ログインしているユーザー名を表示する-->
            <li class="login-name">{{ Auth::user() -> username }} さん</li>

            <li>
                <!-- アコーディオンメニュー -->
                <div class="accordion-item">
                    <h3 class="accordion-title js-accordion-title">
                    </h3>
                    <!--/.accordion-title-->
                    <div class="accordion-content">
                        <p><a href="{{ asset('/top') }}">HOME</a></p>
                        <p><a href="{{ asset('/profile/update') }}">プロフィール編集</a></p>
                        <p><a href="{{ asset('/logout') }}">ログアウト</a></p>
                    </div>
                    <!--/.accordion-content-->
                </div>
                <!-- /.accordion-item -->
            </li>

            <!-- ログインユーザーのアイコン -->
            <!-- もしデフォルトのアイコンだった場合 -->
            @if(auth::user() -> images == 'icon1.png' )
            <a href="/profile/{{ auth::user()->id}}/view">
                <li class="header-icon"><img src="{{ asset('images/'.auth::user() ->images) }}"></li>
            </a>
            <!-- public/images -->
            @else
            <a href="/profile/{{ auth::user()->id}}/view">
                <li class="header-icon"><img src="{{ asset('storage/images/'.auth::user() ->images) }}"></li>
            </a>
            @endif
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
                <div class="side-top">
                    <p class="side-username"> {{ Auth::user() -> username }} さんの</p>
                </div>


                <div class="side-flex">
                    <p class="side-username">フォロー数</p>
                    <p>{{ Auth::user()->follows()->count() }}人</p>
                </div>
                <div class="side-right">
                    <p class="btn btn_base"><a href="{{ asset('/followList') }}">フォローリスト</a></p>
                </div>

                <div class="side-flex">
                    <p class="side-username">フォロワー数</p>
                    <p>{{ Auth::user()->follower()->count() }}人</p>
                </div>
                <div class="side-right">
                    <p class="btn btn_base"><a href="{{ asset('/followerList') }}">フォロワーリスト</a></p>
                </div>
            </div>

            <div class="side-search_btn">
                <p class="btn btn_base"><a href="{{ asset('/search') }}">ユーザー検索</a></p>
            </div>

        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src=" {{ asset('js/script.js') }}"></script>
</body>

</html>
