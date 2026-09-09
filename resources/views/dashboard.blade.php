@extends('layouts.master')

@section('title', 'Admin Dashboard – MC Bloggen')

@section('dashboard')

<section class="min-h-screen bg-zinc-950 text-white">

    {{-- Dashboard Container --}}
    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">

        {{-- Header / Välkomnande --}}
        <div class="mb-10 flex flex-col justify-between gap-4 border-b border-white/10 pb-8 sm:flex-row sm:items-center">
            <div>
                <div class="mb-2 flex items-center gap-3">
                    <span class="h-0.5 w-6 bg-orange-500"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-orange-500">Kontrollpanel</span>
                </div>
                <h1 class="text-4xl font-black tracking-tight">Välkommen tillbaka, Admin<span class="text-orange-500">.</span></h1>
            </div>

            {{-- Snabblänkar: Skapa nytt inlägg --}}
            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('admin.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-500 px-5 py-3 text-sm font-black uppercase tracking-wide text-zinc-950 transition hover:bg-orange-400">
                    + Skapa nytt inlägg
                </a>

                <a
                    href="{{ route('admin.index') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-500 px-5 py-3 text-sm font-black uppercase tracking-wide text-zinc-950 transition hover:bg-orange-400">
                    + Alla inlägg
                </a>

                <a
                    href="{{ route('admin.newsletter.index') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-500 px-5 py-3 text-sm font-black uppercase tracking-wide text-zinc-950 transition hover:bg-orange-400">
                    + Prenumeranter
                </a>

            </div>
        </div>

        <div>
            @yield('admin-content')

            @yield('admin-create')

            @yield('admin-edit')
        </div>


    </div>
</section>
@endsection