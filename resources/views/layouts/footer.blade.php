<footer class="border-t border-white/10 bg-zinc-950">

    <!-- Newsletter -->
    <section id="newsletter-section" class="border-b border-white/10 scroll-mt-12">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-zinc-900/60 px-6 py-10 sm:px-10 lg:px-12"> <!-- Subtil orange glöd -->
                <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-orange-500/10 blur-3xl"></div>
                <div class="relative grid gap-8 lg:grid-cols-2 lg:items-center">
                    <div>
                        <span class="text-sm font-bold uppercase tracking-widest text-orange-500"> MC Bloggen </span>
                        <h2 class="mt-2 text-2xl font-black tracking-tight text-white sm:text-3xl"> Missa inget på vägen. </h2>
                        <p class="mt-3 max-w-xl text-sm leading-6 text-zinc-400"> Prenumerera på vårt nyhetsbrev och få de senaste artiklarna, guiderna, testerna och MC-tipsen direkt till din inkorg. </p>
                    </div>

                    <form action="{{ route('newsletter.subscribe') }}#newsletter-section" method="POST" class="flex w-full lg:justify-end">
                        @csrf
                        <label for="newsletter-email" class="sr-only"> Din e-postadress </label>

                        <div class="flex w-full max-w-xl flex-col gap-2">
                            <!-- Vi lägger till en röd ram dynamiskt om det finns ett valideringsfel -->
                            <div class="flex overflow-hidden rounded-lg border bg-zinc-950 p-1.5 transition {{ $errors->has('email') ? 'border-red-500/50 ring-2 ring-red-500/10' : 'border-white/10 focus-within:border-orange-500/50 focus-within:ring-2 focus-within:ring-orange-500/10' }}">
                                <input
                                    id="newsletter-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Din e-postadress"
                                    required
                                    pattern="[^@\s]+@[^@\s]+\.[^@\s]{2,}"
                                    title="Ange en giltig e-postadress (t.ex. namn@domän.se)"
                                    class="min-w-0 flex-1 rounded-l-md bg-transparent px-3 text-sm text-white outline-none placeholder:text-zinc-600">
                                <button type="submit" class="shrink-0 rounded-md bg-orange-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-orange-400 focus:outline-none">
                                    Prenumerera
                                </button>
                            </div>

                            <!-- Felmeddelande från Laravel (t.ex. om mailen redan finns eller är ogiltig) -->
                            @error('email')
                            <p class="text-xs font-medium text-red-400 pl-1 animate-fade-in">
                                {{ $message }}
                            </p>
                            @enderror

                            <!-- Success-meddelande placerat under -->
                            @session('success')
                            <p class="text-xs font-medium text-emerald-400 pl-1 animate-fade-in">
                                {{ session('success') }}
                            </p>
                            @endsession
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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