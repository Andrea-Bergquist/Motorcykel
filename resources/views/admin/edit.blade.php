@extends('/dashboard')

@section('title', 'Admin Dashboard – MC Bloggen')

@section('admin-edit')

<h1 class="text-3xl font-bold mb-6">Admin Dashboard - MC Bloggen</h1>

@session('success')
<div class="mb-4 rounded-lg bg-green-500 px-4 py-3 text-white">
    {{ session('success') }}
</div>
@endsession

<!-- Flexbox-container som staplar raderna vertikalt med mellanrum -->
<div class="flex flex-col gap-4">

    @foreach ($posts as $post)
    <!-- Varje inlägg blir en rad. Flexar till grid på medelstora skärmar (md:) -->
    <div class="bg-zinc-800 rounded-lg overflow-hidden grid grid-cols-1 md:grid-cols-4 items-center">

        <!-- Bilden tar upp 1/4 av bredden på stora skärmar -->
        <div class="md:col-span-1 h-48 w-full">
            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
        </div>

        <!-- Texten tar upp resterande del av bredden -->
        <div class="p-6 md:col-span-2">
            <span class="bg-orange-500 text-zinc-950 px-3 rounded-full text-xs font-bold">{{ $post->created_at->format('Y-m-d') }}</span>
            <h2 class="text-xl font-bold pt-3 mb-2 text-white">{{ $post->title }}</h2>
            <p class="text-gray-400">{{ Str::words($post->content, 20) }}</p>
        </div>

        <!-- Knapparna placeras längst till höger -->
        <div class="p-6 pt-0 md:pt-6 md:col-span-1 flex md:flex-col justify-end gap-2">
            <a href="{{ route('admin.edit', $post->id) }}" class="inline-block text-center bg-orange-500 text-zinc-950 px-4 py-2 rounded-lg hover:bg-orange-400 transition font-medium w-full">Redigera</a>

            <form action="{{ route('admin.destroy', $post->id) }}" method="POST" class="inline-block w-full">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Är du säker på att radera?');" type="submit" class="w-full bg-red-500 text-zinc-950 px-4 py-2 rounded-lg hover:bg-red-400 transition font-medium">Radera</button>
            </form>
        </div>

    </div>
    @endforeach

</div>

@endsection