<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="description" content="{{$site->desc}}"> --}}
    {{-- <link rel="icon" href="{{ asset($site->favicon) }}" sizes="32x32" /> --}}

    {{-- <title>{{$site->title}}</title> --}}
    <title>CPP - Login</title>

    <!-- Styles -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    @yield('lib-style')
    @yield('page-style')
</head>

<body class="{{ request()->is('login') ? 'bg-login' : '' }}">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            @yield('content')
        </div>
    </main>

    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/vendor.js')}}"></script>

    @yield('lib-script')
    @yield('page-script')

</body>

</html>