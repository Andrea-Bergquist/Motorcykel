@extends('layouts.master')

@section('title', 'MC Bloggen – Allt om livet på två hjul')

@section('meta_description', 'MC Bloggen – inspiration, guider, tester och berättelser för dig som älskar motorcyklar.')

@section('content')

{{-- =========================================================
     HERO
    ========================================================= --}}
<section class="relative isolate overflow-hidden">

    {{-- Hero image --}}
    <div class="absolute inset-0 -z-20">

        <img
            src="{{ asset('images/Hero-MC.jpg') }}"
            alt="Motorcyklist på en slingrande väg"
            class="h-full w-full object-cover">

        {{-- Ljusare overlay (sänkt från 55% till 20%) --}}
        <div class="absolute inset-0 bg-black/20"></div>

        {{-- Ljusare gradient från vänster (sänkt startvärde och mjukare övergång) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>

        {{-- Mjukare gradient från botten (tonar ut till helt transparent snabbare) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-transparent to-transparent"></div>

    </div>


    <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-7xl items-center px-6 py-24 lg:px-8">

        <div class="max-w-3xl">

            {{-- Eyebrow --}}
            <div class="mb-6 flex items-center gap-3">

                <span class="h-0.5 w-7 bg-orange-500"></span>

                <span class="text-sm font-bold uppercase tracking-[0.2em] text-orange-500">
                    Vägen börjar här
                </span>

            </div>


            {{-- Heading --}}
            <h1 class="text-5xl font-black leading-[0.95] tracking-tight text-white sm:text-6xl lg:text-8xl">

                Allt om livet

                <br>

                på två hjul<span class="text-orange-500">.</span>

            </h1>


            <p class="mt-8 max-w-xl text-lg leading-8 text-zinc-300 sm:text-xl">
                Inspiration, guider, tester och berättelser
                för dig som älskar motorcyklar.
            </p>


            <div class="mt-10 flex flex-col gap-4 sm:flex-row">

                <a
                    href="#senaste"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-500 px-7 py-4 text-sm font-black uppercase tracking-wide text-zinc-950 transition hover:bg-orange-400">
                    Läs senaste inläggen
                </a>

                <a
                    href="#om"
                    class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-black/20 px-7 py-4 text-sm font-bold uppercase tracking-wide text-white backdrop-blur transition hover:border-white/60 hover:bg-white/10">
                    Om bloggen
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     LATEST POSTS
    ========================================================= --}}
<section
    id="senaste"
    class="bg-zinc-950">
    <div class="mx-auto max-w-6xl px-6 py-24 lg:px-8">

        <div class="mb-14">

            <div class="flex items-center gap-3">

                <span class="h-0.5 w-6 bg-orange-500"></span>

                <h2 class="text-2xl font-black text-white sm:text-3xl">
                    Senaste inläggen
                </h2>

            </div>

            <p class="mt-3 ml-9 text-sm text-zinc-500">
                Nya inlägg publiceras löpande. Senaste först.
            </p>

        </div>

        <div class="mt-16 flex justify-center custom-pagination">
            {{ $posts->fragment('senaste')->links('pagination::bootstrap-4') }}
        </div>

        {{-- =================================================
             Inläggen
        ================================================== --}}

        @foreach ($posts as $post)

        <article class="group border-b border-white/10 pb-10">

            <div class="grid gap-7 md:grid-cols-[240px_1fr_auto] md:items-center">

                <a
                    href="#"
                    class="block overflow-hidden rounded-lg">
                    <img
                        src="{{ asset('images/' . $post->image) }}"
                        alt="Motorcykel på en slingrande landsväg"
                        class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                </a>


                <div>

                    <p class="text-xs font-medium text-zinc-500">
                        {{ ($post->created_at->translatedFormat('j F Y')) }}
                    </p>

                    <h3 class="mt-2 text-2xl font-black text-white transition group-hover:text-orange-400">
                        {{ $post->title }}
                    </h3>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-zinc-400">
                        {!! Str::markdown(Str::words($post->content, 30, '...')) !!}
                    </p>

                    <a
                        href="{{ route('show', ['id' => $post->id]) }}"
                        class="mt-4 inline-flex text-sm font-bold text-orange-500 hover:text-orange-400">
                        Läs mer →
                    </a>

                </div>


                <div class="flex flex-row gap-4 md:flex-col md:items-end">

                    <span class="rounded border border-orange-500/50 px-3 py-1 text-[10px] font-black uppercase text-orange-500">
                        Guider
                    </span>

                    <span class="text-xs text-zinc-500">
                        ◷ {{ $post->reading_time }}
                    </span>

                </div>

            </div>

        </article>

        @endforeach

        {{-- Pagineringen med en klass så JavaScript kan hitta länkarna --}}
        <div class="mt-16 flex justify-center custom-pagination">
            {{ $posts->fragment('senaste')->links('pagination::bootstrap-4') }}
        </div>

        <style>
            /* Hela container-vy */
            .custom-pagination .pagination {
                display: flex;
                gap: 0.5rem;
                list-style: none;
                padding: 0;
            }

            /* Alla knappar */
            .custom-pagination .page-item .page-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 2.5rem;
                height: 2.5rem;
                padding: 0 0.75rem;
                font-size: 0.875rem;
                font-weight: 700;
                border-radius: 0.5rem;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                background-color: #18181b !important;
                /* bg-zinc-900 */
                color: #a1a1aa !important;
                /* text-zinc-400 */
                text-decoration: none;
                transition: all 0.2s;
            }

            /* Hovring på klickbara knappar */
            .custom-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
                background-color: #27272a !important;
                /* bg-zinc-800 */
                color: #ffffff !important;
                border-color: rgba(255, 255, 255, 0.2) !important;
            }

            /* Den AKTIVA sidan (Orange!) */
            .custom-pagination .page-item.active .page-link {
                background-color: #f97316 !important;
                /* bg-orange-500 */
                border-color: #f97316 !important;
                color: #09090b !important;
                /* text-zinc-950 */
            }

            /* Inaktiverade knappar */
            .custom-pagination .page-item.disabled .page-link {
                opacity: 0.4;
                cursor: not-allowed;
            }
        </style>

        {{-- JavaScript som tvingar webbläsaren att hoppa direkt utan animation --}}
        <script>
            document.querySelectorAll('.custom-pagination a').forEach(link => {
                link.addEventListener('click', () => {
                    document.documentElement.style.scrollBehavior = 'auto';
                });
            });
        </script>

    </div>
    {{-- =========================================================
     CATEGORIES
    ========================================================= --}}
    <section
        id="kategorier"
        class="border-t border-white/10 bg-zinc-900/40">
        <div class="mx-auto max-w-6xl px-6 py-24 lg:px-8">

            <div class="max-w-2xl">

                <div class="flex items-center gap-3">
                    <span class="h-0.5 w-6 bg-orange-500"></span>

                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-orange-500">
                        Utforska
                    </p>
                </div>

                <h2 class="mt-3 text-3xl font-black text-white">
                    Hitta din kategori
                </h2>

            </div>


            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <a
                    href="#"
                    class="rounded-xl border border-white/10 bg-zinc-900 p-6 transition hover:-translate-y-1 hover:border-orange-500/40">
                    <span class="text-2xl">🏍️</span>

                    <h3 class="mt-5 font-bold text-white">
                        Motorcyklar
                    </h3>

                    <p class="mt-2 text-sm text-zinc-500">
                        Modeller, nyheter och inspiration.
                    </p>
                </a>


                <a
                    href="#"
                    class="rounded-xl border border-white/10 bg-zinc-900 p-6 transition hover:-translate-y-1 hover:border-orange-500/40">
                    <span class="text-2xl">🛣️</span>

                    <h3 class="mt-5 font-bold text-white">
                        Resor
                    </h3>

                    <p class="mt-2 text-sm text-zinc-500">
                        Vägar, destinationer och äventyr.
                    </p>
                </a>


                <a
                    href="#"
                    class="rounded-xl border border-white/10 bg-zinc-900 p-6 transition hover:-translate-y-1 hover:border-orange-500/40">
                    <span class="text-2xl">🔧</span>

                    <h3 class="mt-5 font-bold text-white">
                        Mek & tips
                    </h3>

                    <p class="mt-2 text-sm text-zinc-500">
                        Underhåll och praktiska guider.
                    </p>
                </a>


                <a
                    href="#"
                    class="rounded-xl border border-white/10 bg-zinc-900 p-6 transition hover:-translate-y-1 hover:border-orange-500/40">
                    <span class="text-2xl">⭐</span>

                    <h3 class="mt-5 font-bold text-white">
                        Tester
                    </h3>

                    <p class="mt-2 text-sm text-zinc-500">
                        Tester av hojar och utrustning.
                    </p>
                </a>

            </div>

        </div>
    </section>


    {{-- =========================================================
     ABOUT
    ========================================================= --}}
    <section
        id="om"
        class="bg-zinc-950">
        <div class="mx-auto max-w-6xl px-6 py-24 lg:px-8">

            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

                <div>

                    <div class="flex items-center gap-3">
                        <span class="h-0.5 w-6 bg-orange-500"></span>

                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-orange-500">
                            Om MC Bloggen
                        </p>
                    </div>

                    <h2 class="mt-4 text-3xl font-black text-white sm:text-4xl">
                        För oss som aldrig riktigt slutat längta efter nästa kurva.
                    </h2>

                </div>


                <div class="space-y-5 text-base leading-7 text-zinc-400">

                    <p>
                        MC Bloggen är en plats för motorcyklister som älskar
                        själva resan lika mycket som destinationen.
                    </p>

                    <p>
                        Här hittar du tester, guider, inspiration och berättelser
                        från livet på två hjul.
                    </p>

                </div>

            </div>

        </div>
    </section>

    {{-- =========================================================
     CONTACT FORM
     ========================================================= --}}
    <section
        id="kontakt"
        class="border-t border-white/10 bg-zinc-950">

        <div
            id="kontakt-form"
            class="mx-auto max-w-6xl px-6 py-24 lg:px-8">

            <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">

                {{-- Intro --}}
                <div>

                    <div class="flex items-center gap-3">
                        <span class="h-0.5 w-6 bg-orange-500"></span>

                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-orange-500">
                            Hör av dig
                        </p>
                    </div>

                    <h2 class="mt-4 text-3xl font-black text-white sm:text-4xl">
                        Har du en historia från vägen?
                    </h2>

                    <p class="mt-5 max-w-md text-base leading-7 text-zinc-400">
                        Vi vill gärna höra från dig. Skicka ett meddelande
                        så återkommer vi så snart vi kan.
                    </p>

                </div>


                {{-- Formulär --}}
                <div class="rounded-xl border border-white/10 bg-zinc-900 p-6 sm:p-8">

                    @if (session('success'))
                    <div class="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 p-4 text-sm text-green-400">
                        {{ session('success') }}
                    </div>
                    @endif


                    @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-500/30 bg-red-500/10 p-4">
                        <p class="text-sm font-bold text-red-400">
                            Något gick fel:
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-300">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form
                        action="{{ route('contact.send') }}"
                        method="POST"
                        class="space-y-6">

                        @csrf


                        {{-- Honeypot --}}
                        <div
                            aria-hidden="true"
                            style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">

                            <label for="website">
                                Mc modell
                            </label>

                            <input
                                type="text"
                                id="modell"
                                name="modell"
                                value=""
                                tabindex="-1"
                                autocomplete="off">
                        </div>


                        {{-- Namn --}}
                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-bold text-white">
                                Namn
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="100"
                                autocomplete="name"
                                class="w-full rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-white outline-none transition placeholder:text-zinc-600 focus:border-orange-500"
                                placeholder="Ditt namn">
                        </div>


                        {{-- E-post --}}
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-bold text-white">
                                E-post
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="255"
                                autocomplete="email"
                                class="w-full rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-white outline-none transition placeholder:text-zinc-600 focus:border-orange-500"
                                placeholder="din@email.se">
                        </div>


                        {{-- Ärende --}}
                        <div>
                            <label
                                for="subject"
                                class="mb-2 block text-sm font-bold text-white">
                                Ärende
                            </label>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                required
                                maxlength="150"
                                class="w-full rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-white outline-none transition placeholder:text-zinc-600 focus:border-orange-500"
                                placeholder="Vad gäller ditt meddelande?">
                        </div>


                        {{-- Meddelande --}}
                        <div>
                            <label
                                for="message"
                                class="mb-2 block text-sm font-bold text-white">
                                Meddelande
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="7"
                                required
                                maxlength="5000"
                                class="w-full resize-y rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-white outline-none transition placeholder:text-zinc-600 focus:border-orange-500"
                                placeholder="Skriv ditt meddelande här...">{{ old('message') }}</textarea>
                        </div>


                        {{-- Skicka --}}
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-lg bg-orange-500 px-7 py-4 text-sm font-black uppercase tracking-wide text-zinc-950 transition hover:bg-orange-400 sm:w-auto">
                                Skicka meddelande →
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </section>

    @endsection