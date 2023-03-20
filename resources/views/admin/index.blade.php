<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ панель</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="full">
    <div class="content">
        <header>
            <div>
                <div class="header__title">Админ панель</div>
                <div class="header__button"><a class="btn btn-primary btn-sm" href="{{ route('authLogout') }}">Выход</a></div>
            </div>
        </header>
        <main>
            <div class="p-1">
                <h3>Список записей</h3>
            </div>
        </main>
    </div>
    <footer>
        <div>ЕТП © {!! date("Y") !!}</div>
    </footer>
</div>
@vite(['resources/js/bootstrap.js'])
</body>
</html>
