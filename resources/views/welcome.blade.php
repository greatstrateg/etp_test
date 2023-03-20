<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        @vite(['resources/css/app.css'])
    </head>
    <body>
    <div class="full">
        <div class="content">
            <header>
                <h2>Гарантийные обязательства на доставку грузов</h2>
            </header>
            <main>
                <div class="p-1">
                    <div id="app"></div>
                </div>
            </main>
        </div>
        <footer>
            <div>ЕТП © {!! date("Y") !!}</div>
        </footer>
    </div>

    <div id="app"></div>
    @vite(['resources/js/app.js'])
    </body>
</html>
