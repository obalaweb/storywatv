@props(['layout'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if (!auth()->check())
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-LW2G0WKDY3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-LW2G0WKDY3');
        </script>
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="assets/images/favicon-1.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/libs/bootstrap/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/ionicons-2.0.1/css/ionicons.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/libs/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/libs/magnific-popup/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
    <!--===============================================================================================-->
</head>

<body class="responsive {{ $layout ?? 'home-1' }}">


    <div id="wrapper-container">
        @include('layouts.header')
        {{ $slot }}

        @if (!request()->is('/'))
            @include('layouts.footer')
        @endif
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/jquery/jquery.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('assets/js/libs/bootstrap/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/slick/slick.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/isotope/isotope.pkgd.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/libs/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/thim-custom.js') }}"></script>
    @stack('scripts')
    <div id="back-to-top" class="btn-back-to-top">
        <i class="ion ion-ios-arrow-thin-up"></i>
    </div>


</body>

</html>
