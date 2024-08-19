<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <link rel="icon" href="{{ Vite::asset('resources/images/digitalworld.webp') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..40,200..400,0..1,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..40,200..400,0,0" />
    @vite($cssDir . '/main.css')
    @vite($cssDir . '/element.css')
    @vite($viewsDir . '/components/general/header/index.css')
    @vite($viewsDir . '/components/general/footer/index.css')
    @vite($viewsDir . '/components/general/super-menu/index.css')
    @vite($viewsDir . '/components/general/popup/location-select/index.css')
    @yield('styles')
</head>

<body>
    <x-general.header.index></x-general.header.index>
    @section('large-banner')
    @show

    <div class="container">
        @yield('content')
    </div>
    <x-general.footer.index></x-general.footer.index>

    @vite($jsDir . '/default.js')
    @yield('scripts')
</body>

</html>
