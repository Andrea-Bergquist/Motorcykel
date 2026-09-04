@extends('layouts.master')

@section('title', $post->title . ' – MC Bloggen')

@section('meta_description', Str::words(strip_tags($post->content), 25, '...'))

@section('post')

<section class="bg-zinc-950">

    {{-- =========================================================
     ARTICLE HEADER
    ========================================================= --}}
    <div class="border-b border-white/10">
        <div class="mx-auto max-w-4xl px-6 pb-16 pt-20 lg:px-8 lg:pb-20 lg:pt-28">

            {{-- Tillbaka --}}
            <a
                href="{{ url('/')}}"
                class="inline-flex items-center gap-2 text-sm font-bold text-zinc-500 transition hover:text-orange-400">
                <span>←</span>
                Tillbaka till bloggen
            </a>

            {{-- Meta --}}
            <div class="mt-10 flex flex-wrap items-center gap-x-4 gap-y-2">

                <span class="h-0.5 w-6 bg-orange-500"></span>

                <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                    Guider
                </span>

                <span class="text-xs text-zinc-600">
                    •
                </span>

                <span class="text-xs font-medium text-zinc-500">
                    {{ $post->created_at->translatedFormat('j F Y') }}
                </span>

                <span class="text-xs text-zinc-600">
                    •
                </span>

                <span class="text-xs font-medium text-zinc-500">
                    ◷ {{ $post->reading_time }}
                </span>

            </div>

            {{-- Titel --}}
            <h1 class="mt-6 text-4xl font-black leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-6xl">
                {{ $post->title }}<span class="text-orange-500">.</span>
            </h1>

        </div>
    </div>


    {{-- =========================================================
     ARTICLE IMAGE
    ========================================================= --}}
    <div class="mx-auto max-w-6xl px-6 py-12 lg:px-8 lg:py-16">

        <figure class="overflow-hidden rounded-xl border border-white/10 bg-zinc-900">

            <img
                src="{{ asset('images/' . $post->image) }}"
                alt="{{ $post->title }}"
                class="aspect-[16/9] w-full object-cover">

        </figure>

    </div>


    {{-- =========================================================
     ARTICLE CONTENT
    ========================================================= --}}
    <div class="mx-auto max-w-3xl md:max-w-4xl xl:max-w-5xl px-6 pb-24 lg:px-8 lg:pb-32">

        <article class="prose prose-invert prose-zinc max-w-none
                    prose-headings:font-black
                    prose-headings:tracking-tight
                    prose-headings:text-white
                    prose-p:text-zinc-400
                    prose-p:leading-8
                    prose-p:text-base
                    prose-a:text-orange-500
                    prose-a:no-underline
                    hover:prose-a:text-orange-400
                    prose-strong:text-white
                    prose-blockquote:border-orange-500
                    prose-blockquote:text-zinc-300
                    prose-li:text-zinc-400
                    prose-img:rounded-xl">

            {!! \Illuminate\Support\Str::markdown($post->content) !!}

        </article>


        {{-- =====================================================
         EXTRA IMAGES
        ====================================================== --}}
        @if ($post->images->count())

        <div class="mt-16 space-y-12 border-t border-white/10 pt-16">

            @foreach ($post->images as $image)

            <figure>

                <div class="overflow-hidden rounded-xl border border-white/10 bg-zinc-900">

                    <img
                        src="{{ asset('images/' . $image->image) }}"
                        alt="{{ $image->caption ?? $post->title }}"
                        class="w-full object-cover">

                </div>

                @if ($image->caption)

                <figcaption class="mt-3 text-sm leading-6 text-zinc-500">
                    {{ $image->caption }}
                </figcaption>

                @endif

            </figure>

            @endforeach

        </div>

        @endif


        {{-- =====================================================
         BACK TO BLOG
        ====================================================== --}}
        <div class="mt-16 border-t border-white/10 pt-8">

            <a
                href="{{ url('/') }}"
                class="inline-flex items-center gap-3 text-sm font-black uppercase tracking-wide text-orange-500 transition hover:text-orange-400">

                <span class="text-lg">←</span>

                Tillbaka till alla inlägg

            </a>

        </div>

    </div>

</section>

@endsection