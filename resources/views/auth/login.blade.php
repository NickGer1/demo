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

<div class="wrap">
    <h2 style="margin: 0 0 15px;">Вход</h2>

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

    <form METHOD="POST" action="{{ route('login.store') }}">
        @csrf

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

        <button class="btn" type="submit">Войти</button>
        <a href="{{ route('register') }}" class="back">
            Нет аккаунта? Регистрация
        </a>
    </form>
</div>

</body>
</html>
