@extends('/dashboard')

@section('title', 'Skapa inlägg – MC Bloggen')

@section('admin-create')

<div
    class="max-w-3xl mx-auto"
    x-data="{
        images: [],

        addImage() {
            this.images.push({
                id: Date.now() + Math.random(),
                caption: ''
            });
        },

        removeImage(id) {
            this.images = this.images.filter(image => image.id !== id);
        }
    }"
>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <h1 class="text-3xl font-bold text-white">
            Skapa nytt inlägg
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


    <!-- Formulär -->
    <div class="bg-zinc-800 rounded-lg p-6 shadow-xl">

        <form
            action="{{ route('admin.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf


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
                    value="{{ old('title') }}"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition @error('title') border-red-500 @enderror"
                    placeholder="Skriv inläggets titel..."
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
                    placeholder="Skriv ditt blogginlägg här..."
                    required
                >{{ old('content') }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Huvudbild -->
            <div>

                <label
                    for="image"
                    class="block text-sm font-medium text-gray-300 mb-2"
                >
                    Huvudbild
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-lg px-4 py-2 text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-zinc-950 hover:file:bg-orange-400 transition cursor-pointer @error('image') border-red-500 @enderror"
                    required
                >

                <p class="text-xs text-gray-500 mt-1.5">
                    Huvudbilden visas som inläggets primära bild. Max 2 MB.
                </p>

                @error('image')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Extra bilder -->
            <div class="border-t border-zinc-700 pt-6">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Bilder i inlägget
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Lägg till valfritt antal bilder som hör till inlägget.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="addImage()"
                        class="inline-flex items-center gap-2 bg-orange-500 text-zinc-950 px-4 py-2 rounded-lg hover:bg-orange-400 transition font-semibold text-sm"
                    >
                        <span class="text-lg leading-none">+</span>
                        Lägg till bild
                    </button>

                </div>


                <!-- Bildkort -->
                <div class="space-y-4">

                    <template x-for="(image, index) in images" :key="image.id">

                        <div class="bg-zinc-900 border border-zinc-700 rounded-lg p-4">

                            <div class="flex items-center justify-between mb-4">

                                <h3 class="text-sm font-semibold text-white">
                                    Bild <span x-text="index + 1"></span>
                                </h3>

                                <button
                                    type="button"
                                    @click="removeImage(image.id)"
                                    class="text-xs font-medium text-gray-400 hover:text-red-400 transition"
                                >
                                    Ta bort
                                </button>

                            </div>


                            <!-- Bild -->
                            <div class="mb-4">

                                <label
                                    :for="'post-image-' + image.id"
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Bild
                                </label>

                                <input
                                    type="file"
                                    :id="'post-image-' + image.id"
                                    name="post_images[]"
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2 text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-zinc-950 hover:file:bg-orange-400 transition cursor-pointer"
                                >

                            </div>


                            <!-- Caption -->
                            <div>

                                <label
                                    :for="'caption-' + image.id"
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Bildtext
                                </label>

                                <input
                                    type="text"
                                    :id="'caption-' + image.id"
                                    :name="'captions[]'"
                                    x-model="image.caption"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-orange-500 transition"
                                    placeholder="Beskriv bilden..."
                                >

                            </div>

                        </div>

                    </template>

                </div>


                <!-- Ingen bild -->
                <div
                    x-show="images.length === 0"
                    class="border border-dashed border-zinc-700 rounded-lg p-8 text-center"
                >

                    <p class="text-sm text-gray-500">
                        Inga extra bilder har lagts till.
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
                    Skapa inlägg
                </button>

            </div>

        </form>

    </div>

</div>

@endsection