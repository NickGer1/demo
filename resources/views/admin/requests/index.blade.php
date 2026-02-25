<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ панель</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('components.header')

    @if (session('admin_status_updated'))
    <div class="toast" role="status" aria-live="polite">
        <div class="toast__title">✅ Статус обновлён</div>
        <div class="toast__text">Изменения сохранены.</div>
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

    @php
    $typeOptions = [
    'зал',
    'ресторан',
    'летняя веранда',
    'закрытая веранда',
    ];

    $statusLabels = ['new' => 'Новая', 'approved' => 'Банкет назначен', 'rejected' => 'Банкет завершен'];
    $statusClasses = ['new' => 'status--new', 'approved' => 'status--approved', 'rejected' => 'status--rejected'];
    @endphp

    <div class="wrap wrap-lg">
        <div class="page-head">
            <h2 style="margin:0;">Заявки пользователей</h2>
        </div>

        @if ($claims->count() === 0)
        <div style="font-size:14px; color:#666;">Заявок пока нет.</div>
        @else
        <div class="claims-grid">
            @foreach ($claims as $claim)
            @php
            $dateText = $claim->date
            ? (method_exists($claim->date, 'format') ? $claim->date->format('d.m.Y') : \Carbon\Carbon::parse($claim->date)->format('d.m.Y'))
            : '—';

            $statusText = $statusLabels[$claim->status] ?? $claim->status;
            $statusClass = $statusClasses[$claim->status] ?? 'status--new';

            $canChange = $claim->status === 'new';
            @endphp

            <div class="claim-card">
                <div class="claim-top">
                    <div class="claim-number">{{ $claim->date }}</div>
                    <span class="status {{ $statusClass }}">{{ $statusText }}</span>
                </div>

                <div class="claim-sub">
                    #{{ $claim->id }}
                    • {{ $claim->created_at->format('d.m.Y H:i') }}
                    • Помещение: {{ $claim->place }}
                    • Дата: {{ $dateText }}
                    • Способ оплаты: {{ $claim->pay }}
                </div>

                <div class="claim-sub" style="margin-top:4px;">
                    Пользователь:
                    {{ $claim->user->full_name ?? '—' }}
                    (логин: {{ $claim->user->login ?? '—' }})
                </div>

                <form class="claim-actions" method="POST" action="{{ route('admin.requests.status', $claim) }}">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="select-sm" @disabled(!$canChange)>
                        <option value="">— выбрать —</option>
                        <option value="approved">Банкет назначен</option>
                        <option value="rejected">Банкет завершен</option>
                    </select>

                    <button class="btn btn-sm" type="submit" @disabled(!$canChange)>
                        Применить
                    </button>
                </form>

                @unless($canChange)
                <div class="claim-sub" style="margin-top:8px; color:#666;">
                    Статус уже установлен — изменить нельзя.
                </div>
                @endunless
            </div>
            @endforeach
        </div>

        @if ($claims->hasPages())
        <div class="pager">
            @if ($claims->onFirstPage())
            <span class="pager__btn is-disabled">← Назад</span>
            @else
            <a class="pager__btn" href="{{ $claims->previousPageUrl() }}">← Назад</a>
            @endif

            <span class="pager__info">Стр. {{ $claims->currentPage() }} из {{ $claims->lastPage() }}</span>

            @if ($claims->hasMorePages())
            <a class="pager__btn" href="{{ $claims->nextPageUrl() }}">Вперёд →</a>
            @else
            <span class="pager__btn is-disabled">Вперёд →</span>
            @endif
        </div>
        @endif
        @endif
    </div>

</body>

</html>
