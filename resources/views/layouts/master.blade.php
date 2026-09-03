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
    </main>

    <footer class="border-t border-white/10 bg-zinc-950">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">

            <div class="grid gap-10 md:grid-cols-3">

                <div>
                    <div class="text-2xl font-black">
                        <span class="text-orange-500">MC</span>
                        Bloggen
                    </div>

                    <p class="mt-3 max-w-sm text-sm leading-6 text-zinc-500">
                        En blogg för alla som lever för friheten på två hjul.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-white">
                        Snabblänkar
                    </h3>

                    <div class="mt-4 space-y-3 text-sm text-zinc-500">
                        <a href="#senaste" class="block hover:text-orange-400">
                            Senaste inläggen
                        </a>

                        <a href="#kategorier" class="block hover:text-orange-400">
                            Kategorier
                        </a>

                        <a href="#om" class="block hover:text-orange-400">
                            Om bloggen
                        </a>

                        <a href="#kontakt" class="block hover:text-orange-400">
                            Kontakta oss
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-white">
                        Följ oss
                    </h3>

                    <div class="mt-4 flex gap-3">
                        <a
                            href="#"
                            aria-label="Instagram"
                            class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/10 text-zinc-400 transition hover:border-orange-500/30 hover:text-orange-400">
                            IG
                        </a>

                        <a
                            href="#"
                            aria-label="Youtube"
                            class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/10 text-zinc-400 transition hover:border-orange-500/30 hover:text-orange-400">
                            YT
                        </a>

                        <a
                            href="#"
                            aria-label="Facebook"
                            class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/10 text-zinc-400 transition hover:border-orange-500/30 hover:text-orange-400">
                            FB
                        </a>
                    </div>
                </div>

            </div>

            <div class="mt-12 border-t border-white/10 pt-6 text-xs text-zinc-600">
                &copy; {{ date('Y') }} MC Bloggen. Alla rättigheter förbehållna.
            </div>

        </div>
    </footer>

</body>

</html>