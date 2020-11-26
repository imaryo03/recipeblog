<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">レシピブログ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                レシピ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <ul class="dropdown-menu-inner">
                        <li><a class="dropdown-item" href="{{route('blog.index')}}">一覧</a></li>
                        <li><a class="dropdown-item" href="{{route('blog.create')}}">投稿</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                タグ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <ul class="dropdown-menu-inner">
                        <li><a class="dropdown-item" href="{{route('tag.index')}}">一覧</a></li>
                        <li><a class="dropdown-item" href="{{route('tag.create')}}">投稿</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                楽天レシピ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <ul class="dropdown-menu-inner">
                        <li><a class="dropdown-item" href="{{route('rakuten.index')}}">カテゴリー</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ぐるなび
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <ul class="dropdown-menu-inner">
                        <li><a class="dropdown-item" href="{{route('gurunavi.index')}}">エリア一覧</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    アカウント
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul class="dropdown-menu-inner">
                        <li><a class="dropdown-item" href="{{route('blog.mypage')}}">自分のレシピ一覧</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
          

          </ul>
        </div>
</nav>