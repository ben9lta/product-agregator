@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Главная</a>
        @else
            <a href="{{ route('login') }}">Вход</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Регистрация</a>
            @endif
        @endauth
    </div>
@endif
