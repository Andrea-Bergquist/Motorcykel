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
                        {{ date('Y-F-d', strtotime($post->created_at)) }}
                    </p>

                    <h3 class="mt-2 text-2xl font-black text-white transition group-hover:text-orange-400">
                        {{ $post->title }}
                    </h3>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-zinc-400">
                        {{ Str::words($post->content, 10, '...') }}
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
     CTA
========================================================= --}}
    <section
        id="kontakt"
        class="bg-orange-500">
        <div class="mx-auto max-w-6xl px-6 py-20 lg:px-8">

            <div class="flex flex-col gap-8 md:flex-row md:items-center md:justify-between">

                <div class="max-w-2xl">

                    <p class="text-sm font-black uppercase tracking-[0.2em] text-zinc-950/60">
                        Hör av dig
                    </p>

                    <h2 class="mt-2 text-3xl font-black text-zinc-950 sm:text-4xl">
                        Har du en historia från vägen?
                    </h2>

                    <p class="mt-4 text-zinc-950/70">
                        Vi vill gärna höra om dina bästa turer, favoritvägar
                        och motorcykeläventyr.
                    </p>

                </div>


                <a
                    href="mailto:hej@mcbloggen.se"
                    class="shrink-0 rounded-lg bg-zinc-950 px-7 py-4 text-sm font-bold text-white transition hover:bg-zinc-800">
                    Kontakta oss →
                </a>

            </div>

        </div>
    </section>

@endsection