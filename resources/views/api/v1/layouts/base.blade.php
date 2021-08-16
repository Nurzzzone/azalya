<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> {{-- icons --}}
    <link href="{{ asset('css/flag.min.css') }}" rel="stylesheet"> {{-- icons --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> {{-- styles --}}
    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
</head>

<body class="c-app">

<div class="c-wrapper">
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
