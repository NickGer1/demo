<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.header')

@if (session('register_success'))
    @php($loginUrl = url('/login'))
    <div class="toast" role="status" aria-live="polite">
        <div class="toast__title">Регистрация успешна</div>
        <div class="toast__text">Сейчас перенаправлю вас на страницу входа...</div>
        <div class="toast__progress">
            <div class="toast__bar"></div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = @json($loginUrl);
        }, 5000);
    </script>
@endif

<div class="wrap">
    <h2 style="margin: 0 0 15px;">Регистрация</h2>

    @if ($errors->any())
        <div class="toperr">
            <div style="font-weight: 700; margin-bottom: 3px;">Проверьте поля:</div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form METHOD="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="row">
            <label for="full_name">ФИО</label>
            <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required maxlength="150"
                   class="@error('full_name') is-invalid @enderror">
            @error('full_name') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="phone">Телефон</label>
            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required maxlength="20"
                   class="@error('phone') is-invalid @enderror">
            @error('phone') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="190"
                   class="@error('email') is-invalid @enderror">
            @error('email') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="login">Логин</label>
            <input id="login" name="login" type="text" value="{{ old('login') }}" required maxlength="50"
                   class="@error('login') is-invalid @enderror">
            @error('login') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="password">Пароль</label>
            <input id="password" name="password" type="password" value="{{ old('password') }}" required
                class="@error('password') is-invalid @enderror">
            @error('password') <div class="err">{{ $message }}</div> @enderror
        </div>

        <button class="btn" type="submit">Зарегистироваться</button>
        <a href="{{ route('login') }}" class="back">
            Уже есть аккаунт? Вход
        </a>
    </form>
</div>

</body>
</html>
