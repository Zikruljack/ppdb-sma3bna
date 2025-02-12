<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .logo-smantig {
            margin-top: 10px;
            width: 50px;
            height: auto;
        }
    </style>

</head>

<body>
    <div class="content-wrapper">
        @include('layouts.site.header')
        @yield('hero')
        @yield('content')

        @include('layouts.site.footer')
    </div>
    {{-- script --}}
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>

</html>
