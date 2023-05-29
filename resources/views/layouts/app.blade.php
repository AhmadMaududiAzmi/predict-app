<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content="{{ $site->desc }}"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="icon" href="{{ url('/'.$site->favicon) }}" sizes="32x32"> --}}
    <title>CPP - Comodities Price Predict</title>

    {{-- Styles --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('lib-style')
    @yield('page-style')
</head>

<body class="antialiased">
    <div class="wrapper">
        @include('partials.sidebar')
        <div class="main">
            @include('partials.topbar')
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>
            @include('partials.footer')
        </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    
    @yield('lib-script')
    @yield('page-script')
</body>

</html>