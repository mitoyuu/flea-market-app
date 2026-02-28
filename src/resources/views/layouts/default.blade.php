<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <img src="{{ asset('img/COACHTECHヘッダーロゴ.png') }}" alt="ヘッダーロゴ">
                <!-- 検索欄 -->
                @if (Auth::check())
                <form action="/search" method="get" class="search-form">
                    <input type="search" name="input" value="{{ request('input') }}" placeholder="なにをお探しですか？">
                    <!-- マイリスト（?tab=mylist）の状態でも検索を維持したい場合、
                    現在のタブ情報を隠しデータとして持つ工夫が必要になることあり -->
                    <!-- @if(request('tab') == 'mylist')
                    <input type="hidden" name="tab" value="mylist">
                    @endif -->
                </form>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/mypage">マイページ</a>
                        </li>
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                            <a class="header-nav__link" href="/sell">出品</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>