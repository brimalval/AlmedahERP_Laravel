<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSRF Token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ALMEDAH ERP</title>

    @include('layouts.imports')
    
    <style>
        .close {
            opacity: 20%;
            font-size: 100%;
        }
    </style>
</head>

<body >
    <main>
        @yield('content')
    </main>

</body>

</html>