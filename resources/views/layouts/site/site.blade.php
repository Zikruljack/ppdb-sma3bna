<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | SMAN 3 Banda Aceh </title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/logo_smantig.png') }}" type="image/x-icon">

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .logo-smantig {
            margin-top: 10px;
            margin-bottom: 10px;
            width: 50px;
            height: auto;
        }

        .logo-smantig-footer {
            margin-top: 10px;
            width: 80px;
            height: auto;
        }
    </style>

</head>

<body>
    <div class="content-wrapper">
        @include('layouts.site.header')
        @yield('hero')
        @yield('content')

        @if (session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "{{ session('error') }}",
                    });
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                    });
                });
            </script>
        @endif


        @include('layouts.site.footer')
    </div>
    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
