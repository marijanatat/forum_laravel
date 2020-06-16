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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async="" src="https://cdn.livechatinc.com/tracking.js"></script>

    <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '5588603d1fdf728e9b321bf2581309115dd9cb88';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>
    

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
        .ais-highllight>em{
            background: yellow;font-style: normal
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
        @include('modals.all')
    </div>
</body>

</html>