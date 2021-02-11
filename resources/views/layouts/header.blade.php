<header>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">{{env('APP_NAME')}}</a>

        <ul class="navigation">
            <li><a href="/">Главная</a></li>
            <li><a href="/catalog">Каталог</a></li>
            <li><a href="/about">О нас</a></li>
        </ul>
        <ul class="nav">
            <form method="get" action="" class="search-product">
                <input type="search" name="search-product" placeholder="Поиск"/>
                <input type="submit" value="Найти">
            </form>
        </ul>

        <ul class="nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                    </li>
                @endif
            @else

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="nav-link form-inline" href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout').submit()" >Выйти
                            <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>

            @endguest
        </ul>
    </nav>
</header>


