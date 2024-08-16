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
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..40,200..400,0..1,0" />
    @vite($viewsDir . '/layouts/admin/index.css')
    @vite($viewsDir . '/components/admin/sidebar/index.css')
    @vite($cssDir . '/admin/bootstrap.min.css')
    @vite($cssDir . '/admin/kaiadmin.css')
    @vite($cssDir . '/admin/plugins.min.css')
    @vite($cssDir . '/main.css')
    @vite($cssDir . '/element.css')
    @yield('styles')
</head>

<body>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="f-container">
        <x-admin.sidebar></x-admin.sidebar>
        @yield('content')
    </div>

    @vite($jsDir . '/default.js')
    @vite($jsDir . '/admin/jquery-3.7.1.min.js')
    @vite($jsDir . '/admin/bootstrap.min.js')
    @vite($jsDir . '/admin/popper.min.js')
    @vite($jsDir . '/admin/kaiadmin.min.js')
    {{-- @vite($jsDir . '/admin/sidebar.js') --}}
    @yield('scripts')
</body>

</html>
