<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('additional-meta')
    <title>@yield('page-title',)</title>

    @yield('additional-cdn')
</head>
<body>
    {{-- Includi header --}}
    @include('partials.header')

    {{-- Inserisci contenuti da chi estende --}}
    <main>
        @yield('main-content')
    </main>

    {{-- Includi footer --}}
    @include('partials.footer')

    @yield('additional-script')
    @vite('resources/js/app.js')
</body>
</html>
