<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Cloud Payments') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Scripts-->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="antialiased">
<div id="app">
    <nav-bar :navbar-brand-title='@json(config('app.name', 'Cloud Payments'))'></nav-bar>
    <div class="container-fluid">
        <div class="row">
            <side-bar></side-bar>
            <shop-main></shop-main>
        </div>
    </div>

</div>
</body>
</html>
