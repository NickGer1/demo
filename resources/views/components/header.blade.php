<header class="header">
    <div class="header__inner">
        <a href="{{ route('home') }}" class="header__logo">Банкетам.Нет</a>
        <div class="header__btns">
            @guest
                <a href="{{ route('login') }}" class="header__btn">Вход</a>
                <a href="{{ route('register') }}" class="header__btn">Регистрация</a>
            @endguest

            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.requests.index') }}" class="header__btn">Заявки пользователей</a>
                @else
                    <a href="{{ route('claims.create') }}" class="header__btn">Создать заявку</a>
                    <a href="{{ route('requests.index') }}" class="header__btn">Мои заявки</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="header__btn">Выйти</button>
                </form>
            @endauth
        </div>
    </div>
</header>
