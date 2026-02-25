<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мои заявки</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.header')

<div class="wrap wrap-lg">
    <div class="page-head">
        <h2 style="margin: 0 0 15px;">Мои заявки</h2>
        <a href="{{ route('claims.create') }}" class="btn btn-inline">Создать заявку</a>
    </div>

    @if ($claims->count() === 0)
        <div style="font-size: 14px; color: #666;">
            Пока заявок нет. Нажмите "создать заявку".
        </div>
    @else
        <div class="claims-grid">
            @foreach($claims as $claim)
                @php
                    $labels = ['new'=>'Новая', 'approved' => 'Банкет назначен', 'rejected' => 'Банкет завершен'];
                    $classes = ['new' => 'status--new', 'approved' => 'status--approved', 'rejected' => 'status--rejected'];

                    $statusLabel = $labels[$claim->status] ?? $claim->status;
                    $statusClass = $classes[$claim->status] ?? 'status--new'
                @endphp

                <div class="claim-card">
                    <div class="claim-top">
                        <div class="claim-number">{{ $claim->date }}</div>
                        <span class="status {{ $statusClass }}">{{ $statusLabel  }}</span>
                    </div>

                    <div class="claim-sub">
                        №{{ $claim->id }} <br>
                        Помещение: {{ $claim->place }} <br>
                        Дата: {{ $claim->date }} <br>
                        Способ оплаты: {{ $claim->pay }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
