<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title> --}}
    <!-- Font -->
    <script src="https://kit.fontawesome.com/2ee5c96cad.js" crossorigin="anonymous"></script>

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Assignment-ART</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('css')
</head>

<body>

    @include('layouts.frontend.partial.header')

    @yield('content')

    @include('layouts.frontend.partial.footer')

    <!-- SCIPTS -->
    <script src="{{ asset('assets/frontend/js/jquery-3.1.1.min.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/tether.min.js') }}"></script>

    <script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- {!! Toastr::message() !!} --}}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
    </script>
    @stack('js')
    <!--Start of Tawk.to Script-->

    <!--End of Tawk.to Script-->
   

    {{ \TawkTo::widgetCode( env('TAWKTO_LINK')) }}
    {{-- {{ \TawkTo::widgetCode('https://embed.tawk.to/6533ae08f2439e1631e6b69f/1hd8tvl34') }} --}}
</body>

</html>
