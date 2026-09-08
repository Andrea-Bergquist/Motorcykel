@extends('/dashboard')

@section('title', 'Redigera inlägg – MC Bloggen')

@section('admin-edit')

<div class="max-w-3xl mx-auto">
    <!-- Header med Tillbaka-länk -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold text-white">Redigera inlägg</h1>
        <a href="{{ route('admin.index') }}" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-500 transition">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Tillbaka till listan
        </a>
    </div>

    <!-- Huvudformulär i samma mörka stil som index-raderna -->
    <div class="bg-zinc-800 rounded-lg p-6 shadow-xl">
        
        <form action="{{ route('admin.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Titel -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Titel</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition @error('title') border-red-500 @enderror" 
                    required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Innehåll / Text -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Innehåll</label>
                <textarea name="content" id="content" rows="8" 
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition @error('content') border-red-500 @enderror" 
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bild-sektion (Visar nuvarande bild + filväljare) -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Inläggsbild</label>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-start">
                    <!-- Nuvarande bild -->
                    <div class="sm:col-span-1">
                        <p class="text-xs text-gray-400 mb-1">Nuvarande bild:</p>
                        <div class="h-32 w-full rounded-lg overflow-hidden bg-zinc-900 border border-zinc-700">
                            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Ladda upp ny bild -->
                    <div class="sm:col-span-2">
                        <p class="text-xs text-gray-400 mb-1">Ladda upp ny bild (valfritt):</p>
                        <input type="file" name="image" id="image" 
                            class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2 text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-zinc-950 hover:file:bg-orange-400 transition cursor-pointer @error('image') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1.5">Lämna tom om du vill behålla den nuvarande bilden.</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Knappar längst ner (Spara / Avbryt) -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-700">
                <a href="{{ route('admin.index') }}" 
                    class="bg-zinc-700 text-white px-5 py-2.5 rounded-lg hover:bg-zinc-600 transition font-medium text-sm">
                    Avbryt
                </a>
                <button type="submit" 
                    class="bg-orange-500 text-zinc-950 px-5 py-2.5 rounded-lg hover:bg-orange-400 transition font-medium text-sm shadow-md">
                    Spara ändringar
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
