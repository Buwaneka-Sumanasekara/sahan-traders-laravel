<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Sahan Traders') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style type="text/css">
        i {
            font-size: 50px;
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-organisms.header />
            </div>
        </div>
        @yield('content')
        <div class="row">
            <div class="col-md-12">
                <x-organisms.footer />
            </div>
        </div>
    </div>

</body>

</html>
