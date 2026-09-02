<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-white/10 bg-zinc-950/95 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="flex h-20 items-center justify-between">

            {{-- Logo --}}
            <a
                href="{{ url('/') }}"
                class="text-xl font-black tracking-tight">
                <span class="text-orange-500">MC</span>
                Bloggen
            </a>


            {{-- Desktop --}}
            <div class="hidden items-center gap-8 md:flex">

                <a
                    href="{{ url('/') }}"
                    class="text-sm font-medium text-white">
                    Hem
                </a>

                <a
                    href="#kategorier"
                    class="text-sm font-medium text-zinc-400 transition hover:text-white">
                    Kategorier
                </a>

                <a
                    href="#om"
                    class="text-sm font-medium text-zinc-400 transition hover:text-white">
                    Om bloggen
                </a>

                <a
                    href="#kontakt"
                    class="text-sm font-medium text-zinc-400 transition hover:text-white">
                    Kontakta
                </a>

                <a
                    href="#senaste"
                    aria-label="Sök"
                    class="text-zinc-400 transition hover:text-orange-400">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="h-5 w-5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z" />
                    </svg>
                </a>

            </div>


            {{-- Mobile button --}}
            <button
                type="button"
                @click="open = !open"
                class="rounded-lg p-2 text-zinc-300 hover:bg-white/5 md:hidden"
                :aria-expanded="open">
                <svg
                    x-show="!open"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

                <svg
                    x-show="open"
                    x-cloak
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

        </div>


        {{-- Mobile --}}
        <div
            x-show="open"
            x-cloak
            x-transition
            class="border-t border-white/10 py-4 md:hidden">
            <div class="space-y-1">

                <a
                    href="{{ url('/') }}"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3 text-sm text-white hover:bg-white/5">
                    Hem
                </a>

                <a
                    href="#kategorier"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3 text-sm text-zinc-400 hover:bg-white/5 hover:text-white">
                    Kategorier
                </a>

                <a
                    href="#om"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3 text-sm text-zinc-400 hover:bg-white/5 hover:text-white">
                    Om bloggen
                </a>

                <a
                    href="#kontakt"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3 text-sm text-zinc-400 hover:bg-white/5 hover:text-white">
                    Kontakta
                </a>

            </div>
        </div>

    </div>
</nav>