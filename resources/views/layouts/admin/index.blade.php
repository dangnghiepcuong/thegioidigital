<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ Vite::asset('resources/images/digitalworld.webp') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..40,200..400,0..1,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..40,200..400,0..1,0" />

    @vite($cssDir . '/app.css')
    @vite($cssDir . '/main.css')
    @vite($cssDir . '/element.css')
    @vite($viewsDir . '/layouts/admin/index.css')
    @vite($viewsDir . '/components/admin/sidebar/index.css')
    @stack('styles')
    @yield('styles')
</head>

<body>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="f-container">
        <x-admin.sidebar2.index></x-admin.sidebar2.index>
        @yield('content')
    </div>

    @vite($jsDir . '/app.js')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @stack('scripts')
    @yield('scripts')
</body>

</html>
