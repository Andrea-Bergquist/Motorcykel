<!-- Byt ut 'layouts.app' mot namnet på din egen masterpage-fil -->
@extends('layouts.master') 

@section('login')

<div class="flex min-h-[60vh] flex-col items-center justify-center px-6">
    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 p-8 rounded-xl shadow-md text-white">
        
        <h2 class="text-xl font-semibold mb-6 text-center">Logga in på bloggen</h2>

        <!-- Session Status (Visar om t.ex. lösenordsåterställning lyckades) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-zinc-300">E-post</label>
                <input id="email" class="mt-1 block w-full rounded-md border-zinc-700 bg-zinc-800 text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-zinc-300">Lösenord</label>
                <input id="password" class="mt-1 block w-full rounded-md border-zinc-700 bg-zinc-800 text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-zinc-700 bg-zinc-800 text-orange-500 shadow-sm focus:ring-orange-500" name="remember">
                    <span class="ms-2 text-sm text-zinc-400">Kom ihåg mig</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-2 px-4 rounded-md transition shadow-md">
                    Logga in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
