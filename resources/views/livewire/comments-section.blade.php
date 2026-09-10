<div class="mt-16 border-t border-white/10 pt-16">

    {{-- Räkna kommentarer live --}}
    <h2 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
        Kommentarer <span class="text-orange-500">({{ $comments->count() }})</span>
    </h2>

    {{-- 1. Koppla formuläret till saveComment --}}
    <form wire:submit="saveComment" class="mt-8 space-y-6 rounded-xl border border-white/10 bg-zinc-900/50 p-6 backdrop-blur-sm">
        <h3 class="text-sm font-black uppercase tracking-wider text-orange-500">Lämna en hälsning</h3>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            
            {{-- HONEYPOT-FÄLT (Dolt för människor, synligt för spam-botar) --}}
            <div class="hidden" aria-hidden="true">
                <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off" placeholder="Leave this field blank">
            </div>

            {{-- Namnfält --}}
            <div class="sm:col-span-2">
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Namn / Alias</label>
                {{-- 2. Lägg till wire:model.blur så att det kopplas live till Livewire --}}
                <input
                    type="text"
                    id="name"
                    wire:model.blur="guest_name"
                    class="mt-2 block w-full rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-sm text-white placeholder-zinc-600 shadow-inner transition focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500"
                    placeholder="T.ex. Sladd-Kalle">

                {{-- Visa valideringsfel för namn --}}
                @error('guest_name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Meddelandefält --}}
            <div class="sm:col-span-2">
                <label for="comment" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Kommentar</label>
                {{-- 2. Lägg till wire:model.blur här också --}}
                <textarea
                    id="comment"
                    rows="4"
                    wire:model.blur="body"
                    class="mt-2 block w-full rounded-lg border border-white/10 bg-zinc-950 px-4 py-3 text-sm text-white placeholder-zinc-600 shadow-inner transition focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500"
                    placeholder="Skriv din kommentar här..."></textarea>

                {{-- Visa valideringsfel för texten --}}
                @error('body') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Skicka-knapp --}}
        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-black uppercase tracking-wider text-zinc-950 transition hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-zinc-900">
                Skicka kommentar
                <span>→</span>
            </button>
        </div>
    </form>

    {{-- 3. Lista med kommentarer hämtade från databasen --}}
    <div class="mt-12 space-y-6">

        @forelse($comments as $comment)
        {{-- wire:key är viktigt i Livewire när man loopar ut element --}}
        <div wire:key="{{ $comment->id }}" class="rounded-xl border border-white/5 bg-zinc-900/20 p-6 transition hover:border-white/10">
            <div class="flex items-center justify-between border-b border-white/5 pb-3">
                <div class="flex items-center gap-3">
                    {{-- Skapar en automatisk första bokstav till avataren --}}
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-500/10 text-xs font-black text-orange-500 uppercase">
                        {{ mb_substr($comment->guest_name, 0, 1) }}
                    </div>
                    <span class="font-bold text-white">{{ $comment->guest_name }}</span>
                </div>
                {{-- Visar när kommentaren skapades (t.ex. 2 minuter sedan) --}}
                <span class="text-xs text-zinc-500">{{ $comment->created_at->diffForHumans() }}</span>

                {{-- VISAS ENDAST FÖR INLOGGADE ANVÄNDARE --}}
                @auth
                <button
                    wire:click="deleteComment({{ $comment->id }})"
                    wire:confirm="Är du säker på att du vill ta bort den här kommentaren?"
                    class="text-xs font-bold uppercase tracking-wider text-red-500 hover:text-red-400 transition focus:outline-none">
                    Radera
                </button>
                @endauth
            </div>
            <div class="mt-4 text-sm leading-7 text-zinc-400">
                <p>{{ $comment->body }}</p>
            </div>
        </div>
        @empty
        {{-- Om det inte finns några kommentarer än --}}
        <p class="text-sm text-zinc-500 text-center py-6">Inga kommentarer ännu. Bli den första att lämna en hälsning!</p>
        @endforelse

    </div>

</div>