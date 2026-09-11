<!DOCTYPE html>
<html lang="sv" class="scroll-smooth">
<!-- Denna webbplats är gjord av Andréa Bergquist i Laravel 13, Tailwind CSS4, Alpine.js och Livewire- PHP 8.5.10 MySql -->
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="@yield('meta_description', 'MC Bloggen – allt om motorcyklar, resor, tester, guider och livet på två hjul.')">

    <title>@yield('title', 'MC Bloggen')</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">

    <x-navbar />

    <main>
        @yield('content')

        @yield('post')

        @yield('login')

        @yield('dashboard')
    </main>

    @include('layouts.footer')

</body>

</html>