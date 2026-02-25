<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание заявки</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.header')

@if (session('claim_success'))
    <div class="toast" role="status" aria-live="polite">
        <div class="toast__title">Заявка отправлена</div>
        <div class="toast__text">Наши специалисты рассмотрят обращение</div>
        <div class="toast__progress">
            <div class="toast__bar"></div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const t = document.querySelector('.toast');
            if (t) t.remove();
        }, 5000);
    </script>
@endif

<div class="wrap">
    <h2 style="margin: 0 0 15px;">Новая заявка</h2>

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

    <form method="POST" action="{{ route('claims.store') }}">
        @csrf

        <div class="row">
            <label for="place">Выберите место</label>
            <select name="place" id="place" required class="@error('place') is-invalid @enderror">
                <option value="">--Выберите--</option>
                <option value="зал" @selected(old('place') === 'зал' )>зал</option>
                <option value="ресторан" @selected(old('place') === 'ресторан' )>ресторан</option>
                <option value="летняя веранда" @selected(old('place') === 'летняя веранда' )>летняя веранда</option>
                <option value="закрытая веранда" @selected(old('place') === 'закрытая веранда' )>закрытая веранда</option>
            </select>
            @error('place') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="date">Дата</label>
            <input id="date" name="date" type="date" value="{{ old('date') }}" required
                   class="@error('date') is-invalid @enderror">
            @error('date') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <label for="pay">Способ оплаты</label>
            <input id="pay" name="pay" type="text" value="{{ old('pay') }}" required maxlength="50"
                   class="@error('pay') is-invalid @enderror">
            @error('pay') <div class="err">{{ $message }}</div> @enderror
        </div>

        <button class="btn" type="submit">Отпрвить заявку</button>
    </form>
</div>

</body>
</html>
