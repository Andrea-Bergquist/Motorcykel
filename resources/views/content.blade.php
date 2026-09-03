@extends('layouts.master')

@section('title', 'MC Bloggen – Allt om livet på två hjul')

@section('meta_description', 'MC Bloggen – inspiration, guider, tester och berättelser för dig som älskar motorcyklar.')

@section('post')

<section
    id="senaste"
    class="bg-zinc-950">
    <div class="mx-auto max-w-6xl px-6 py-24 lg:px-8">

        <div class="mb-14">

            <div class="flex items-center gap-3">

                <span class="h-0.5 w-6 bg-orange-500"></span>

                <h2 class="text-2xl font-black text-white sm:text-3xl">
                    Ditt valda inlägg!
                </h2>

            </div>

            <p class="mt-3 ml-9 text-sm text-zinc-500">
                {{ $post->created_at }}
                {{ $post->title }}
                {!! \Illuminate\Support\Str::markdown($post->content) !!}

                <img src="{{ asset('images/' . $post->image) }}" alt=""
                    class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">

                @foreach ($post->images as $image)
                <img src="{{ asset('images/' . $image->image) }}" alt=""
                    class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                    <span class="mt-3 max-w-sm text-sm leading-6 text-zinc-500">
                        {{ $image->caption }}</span>
                @endforeach

            </p>

        </div>
    </div>

    @endsection