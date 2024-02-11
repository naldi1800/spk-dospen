<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <title>Autentication</title>

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;

        background-color: #f3f0ca;
        color: #192655;
    }


    .foreground {
        background-color: #e1aa74;
        color: #192655;
    }

    .action {
        background-color: #3876bf;
        color: #ffff;
    }

    .object {
        /* background-color: #EEE0C9; */
        color: #192655;
    }

    .table {
        border: 1px solid black;
    }
</style>

<body>
    {{-- @include('partial.navbar') --}}
    {{-- <div class="container mt-3 mb-3"> --}}
    <main class="py-4">
        @yield('container')
    </main>
    {{-- </div> --}}


</body>

</html>
