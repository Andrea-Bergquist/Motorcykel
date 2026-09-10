<div class="max-w-xl mx-auto p-4 space-y-6">
    <h3 class="text-lg font-bold">Kommentarer</h3>

    <!-- Framgångsmeddelande -->
    @if (session()->has('message'))
    <div class="p-2 text-green-700 bg-green-100 rounded">
        {{ session('message') }}
    </div>
    @endif

    <!-- Formulär för att skriva kommentar -->
    <form wire:submit.prevent="saveComment" class="space-y-3 bg-gray-50 p-4 rounded shadow-sm">

        <!-- Visa fält för gästnamn om användaren är oinloggad -->
        @guest
        <div>
            <label class="block text-sm font-medium text-gray-700">Ditt namn (Gäst)</label>
            <input type="text" wire:model="guest_name" class="w-full p-2 border rounded mt-1">
            @error('guest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        @endguest
        <div>
            <label class="block text-sm font-medium text-gray-700">Skriv en kommentar</label>
            <textarea wire:model="body" rows="3" class="w-full p-2 border rounded mt-1" placeholder="Vad tänker du på?"></textarea>
            @error('body') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Skicka kommentar
        </button>
    </form>

    <!-- Lista över kommentarer -->
    <div class="space-y-4">
        @foreach($comments as $comment)
        <div class="p-4 bg-white border rounded shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="font-semibold text-sm">
                    <!-- Visa användarnamn eller gästnamn -->
                    {{ $comment->user ? $comment->user->name : $comment->guest_name . ' (Gäst)' }}
                </span>
                <span class="text-xs text-gray-500">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
            <p class="text-gray-700 whitespace-pre-line">{{ $comment->body }}</p>
        </div>
        @endforeach
    </div>
    
</div>