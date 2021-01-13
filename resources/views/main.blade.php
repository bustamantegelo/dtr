<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/app.css">

        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
