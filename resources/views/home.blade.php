<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.header')

<div class="wrap">
    <div class="slider">
        <div class="slider__item">
            <img src="{{ asset('img/1.jpg') }}" alt="img" class="slider__img">
        </div>
        <div class="slider__item">
            <img src="{{ asset('img/2.jpg') }}" alt="img" class="slider__img">
        </div>
        <div class="slider__item">
            <img src="{{ asset('img/3.jpg') }}" alt="img" class="slider__img">
        </div>
        <div class="slider__item">
            <img src="{{ asset('img/4.jpeg') }}" alt="img" class="slider__img">
        </div>
    </div>
</div>
</body>
</html>
