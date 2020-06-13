<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   

    <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ])!!};
    </script>

    <style>
        body { padding-bottom: 100px; }
        .level { display: flex; align-items: center;}
        .level-item { margin-right :1em;}
        .flex { flex: 1; margin-bottom: 0;}
        [v-cloak] { display: none}
        .heart {width:13px; margin-right: 2px; padding-bottom: 3px;}
        .ml{
            margin-left: auto ;
        }
    </style>
    @yield('header')
</head>

<body>
    <div id="app">
        @include('layouts._nav')

        <main class="py-4">
            @yield('content')
        </main>

        <flash message="{{ session('flash')}}"></flash>
    </div>
</body>

</html>