<!DOCTYPE html>
<html lang="sv" class="scroll-smooth">

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
    </main>

    @include('layouts.footer')

</body>

</html>