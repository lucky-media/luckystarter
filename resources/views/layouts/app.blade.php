<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lucky Starter') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/front/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('assets/front/js/app.js') }}" defer></script>
</head>
<body>
<div id="app">

    <main>
        @yield('content')
    </main>

</div>
</body>
</html>