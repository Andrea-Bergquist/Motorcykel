@extends('/dashboard')

@section('title', 'Redigera inlägg – MC Bloggen')

@section('admin-edit')

<div
    class="max-w-3xl mx-auto"
    x-data="{
        newImages: [],

        addImage() {
            this.newImages.push({
                id: Date.now() + Math.random(),
                caption: ''
            });
        },

        removeNewImage(id) {
            this.newImages = this.newImages.filter(image => image.id !== id);
        }
    }"
>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <h1 class="text-3xl font-bold text-white">
            Redigera inlägg
        </h1>

        <a
            href="{{ route('admin.index') }}"
            class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-500 transition"
        >
            <svg
                class="w-4 h-4 mr-1.5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
            </svg>

            Tillbaka till listan
        </a>

    </div>


    <!-- Huvudformulär -->
    <div class="bg-zinc-800 rounded-lg p-6 shadow-xl">

        <form
            action="{{ route('admin.update', $post->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            <!-- Titel -->
            <div>

                <label
                    for="title"
                    class="block text-sm font-medium text-gray-300 mb-2"
                >
                    Titel
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $post->title) }}"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition @error('title') border-red-500 @enderror"
                    required
                >

                @error('title')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Innehåll -->
            <div>

                <label
                    for="content"
                    class="block text-sm font-medium text-gray-300 mb-2"
                >
                    Innehåll
                </label>

                <textarea
                    name="content"
                    id="content"
                    rows="8"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition @error('content') border-red-500 @enderror"
                    required
                >{{ old('content', $post->content) }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Huvudbild -->
            <div>

                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Huvudbild
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-start">

                    <!-- Nuvarande bild -->
                    <div class="sm:col-span-1">

                        <p class="text-xs text-gray-400 mb-1">
                            Nuvarande bild:
                        </p>

                        <div class="h-32 w-full rounded-lg overflow-hidden bg-zinc-900 border border-zinc-700">

                            <img
                                src="{{ asset('images/' . $post->image) }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover"
                            >

                        </div>

                    </div>


                    <!-- Ny huvudbild -->
                    <div class="sm:col-span-2">

                        <p class="text-xs text-gray-400 mb-1">
                            Ladda upp ny bild (valfritt):
                        </p>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                            class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2 text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-zinc-950 hover:file:bg-orange-400 transition cursor-pointer @error('image') border-red-500 @enderror"
                        >

                        <p class="text-xs text-gray-500 mt-1.5">
                            Lämna tom om du vill behålla den nuvarande bilden. Max 2 MB.
                        </p>

                        @error('image')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- Befintliga bilder -->
            <div class="border-t border-zinc-700 pt-6">

                <div class="mb-4">

                    <h2 class="text-lg font-semibold text-white">
                        Bilder i inlägget
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Redigera bildtexter eller ta bort bilder som redan finns.
                    </p>

                </div>


                @if($post->images->count() > 0)

                    <div class="space-y-4">

                        @foreach($post->images as $postImage)

                            <div class="bg-zinc-900 border border-zinc-700 rounded-lg p-4">

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <!-- Bild -->
                                    <div>

                                        <p class="text-xs text-gray-400 mb-2">
                                            Bild
                                        </p>

                                        <div class="h-32 w-full rounded-lg overflow-hidden bg-zinc-800">

                                            <img
                                                src="{{ asset('images/' . $postImage->image) }}"
                                                alt="{{ $postImage->caption }}"
                                                class="w-full h-full object-cover"
                                            >

                                        </div>

                                    </div>


                                    <!-- Caption -->
                                    <div class="sm:col-span-2">

                                        <label
                                            for="caption-{{ $postImage->id }}"
                                            class="block text-sm font-medium text-gray-300 mb-2"
                                        >
                                            Bildtext
                                        </label>

                                        <input
                                            type="text"
                                            name="existing_captions[{{ $postImage->id }}]"
                                            id="caption-{{ $postImage->id }}"
                                            value="{{ old('existing_captions.' . $postImage->id, $postImage->caption) }}"
                                            class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition"
                                            placeholder="Beskriv bilden..."
                                        >


                                        <!-- Ta bort bild -->
                                        <label class="flex items-center gap-2 mt-4 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="delete_images[]"
                                                value="{{ $postImage->id }}"
                                                class="rounded border-zinc-600 bg-zinc-800 text-orange-500 focus:ring-orange-500"
                                            >

                                            <span class="text-sm text-gray-400">
                                                Ta bort denna bild
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="border border-dashed border-zinc-700 rounded-lg p-8 text-center">

                        <p class="text-sm text-gray-500">
                            Inlägget har inga extra bilder.
                        </p>

                    </div>

                @endif

            </div>


            <!-- Lägg till nya bilder -->
            <div class="border-t border-zinc-700 pt-6">

                <div class="flex items-center justify-between mb-4">

                    <div>

                        <h2 class="text-lg font-semibold text-white">
                            Lägg till nya bilder
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Lägg till valfritt antal nya bilder.
                        </p>

                    </div>


                    <button
                        type="button"
                        @click="addImage()"
                        class="inline-flex items-center gap-2 bg-orange-500 text-zinc-950 px-4 py-2 rounded-lg hover:bg-orange-400 transition font-semibold text-sm"
                    >
                        <span class="text-lg leading-none">
                            +
                        </span>

                        Lägg till bild
                    </button>

                </div>


                <!-- Nya bilder -->
                <div class="space-y-4">

                    <template
                        x-for="(image, index) in newImages"
                        :key="image.id"
                    >

                        <div class="bg-zinc-900 border border-zinc-700 rounded-lg p-4">

                            <div class="flex items-center justify-between mb-4">

                                <h3 class="text-sm font-semibold text-white">

                                    Ny bild
                                    <span x-text="index + 1"></span>

                                </h3>


                                <button
                                    type="button"
                                    @click="removeNewImage(image.id)"
                                    class="text-xs font-medium text-gray-400 hover:text-red-400 transition"
                                >
                                    Ta bort
                                </button>

                            </div>


                            <!-- Bild -->
                            <div class="mb-4">

                                <label
                                    :for="'new-image-' + image.id"
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Bild
                                </label>

                                <input
                                    type="file"
                                    name="post_images[]"
                                    :id="'new-image-' + image.id"
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2 text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-zinc-950 hover:file:bg-orange-400 transition cursor-pointer"
                                >

                            </div>


                            <!-- Caption -->
                            <div>

                                <label
                                    :for="'new-caption-' + image.id"
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Bildtext
                                </label>

                                <input
                                    type="text"
                                    name="captions[]"
                                    :id="'new-caption-' + image.id"
                                    x-model="image.caption"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition"
                                    placeholder="Beskriv bilden..."
                                >

                            </div>

                        </div>

                    </template>

                </div>


                <!-- Inga nya bilder -->
                <div
                    x-show="newImages.length === 0"
                    class="border border-dashed border-zinc-700 rounded-lg p-8 text-center"
                >

                    <p class="text-sm text-gray-500">
                        Inga nya bilder har lagts till.
                    </p>

                    <p class="text-xs text-gray-600 mt-1">
                        Klicka på "Lägg till bild" om du vill lägga till bilder.
                    </p>

                </div>

            </div>


            <!-- Knappar -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-700">

                <a
                    href="{{ route('admin.index') }}"
                    class="bg-zinc-700 text-white px-5 py-2.5 rounded-lg hover:bg-zinc-600 transition font-medium text-sm"
                >
                    Avbryt
                </a>

                <button
                    type="submit"
                    class="bg-orange-500 text-zinc-950 px-5 py-2.5 rounded-lg hover:bg-orange-400 transition font-medium text-sm shadow-md"
                >
                    Spara ändringar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
