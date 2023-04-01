<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('head_title')</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/cadesplugin_api.js'])
    @vite(['resources/js/cryptopro.js'])
</head>
<body>
<div class="full" id="app">
    <div class="content">
        <header>
            <div>
                <div class="header__title">@yield('header_title')</div>
                <div class="header__button">@yield('header_button')</div>
            </div>
        </header>
        <main class="p-1">
            <h3>@yield('body_title')</h3>
            <div>
                @yield('body_content')
            </div>
        </main>
    </div>
    <footer>
        <div>ЕТП © {!! date("Y") !!}</div>
    </footer>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
