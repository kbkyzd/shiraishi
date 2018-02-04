<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ひめかわ')</title>

    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header>
        @include('layouts.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="container">
        </div>
    </footer>
</div>
</body>
@if(app()->isLocal())
    <script src="//{{ request()->getHttpHost() }}:6001/socket.io/socket.io.js"></script>
@else
    <script src="/socket.io/socket.io.js"></script>
@endif
<script src="{{ mix('js/app.js') }}"></script>
</html>
