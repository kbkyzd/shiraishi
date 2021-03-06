<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="{{ mix('css/minimal.css') }}" rel="stylesheet">
</head>
<body>
@yield('content')
<div id="fss-container">
</div>
</body>
<script src="{{ mix('js/legacy.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
@stack('script')
</body>
</html>
