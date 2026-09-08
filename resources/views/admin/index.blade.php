@extends('/dashboard')

@section('title', 'Admin Dashboard – MC Bloggen')

@section('admin-content')

<h1 class="text-3xl font-bold mb-6">Admin Dashboard - MC Bloggen</h1>

@session('success')
<div class="mb-4 rounded-lg bg-green-500 px-4 py-3 text-white">
    {{ session('success') }}
</div>
@endsession

{{-- Pagineringen med en klass så JavaScript kan hitta länkarna --}}
<div class="mt-8 mb-5 flex justify-center custom-pagination">
    {{ $posts->fragment('senaste')->links('pagination::bootstrap-4') }}
</div>

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

    {{-- Pagineringen med en klass så JavaScript kan hitta länkarna --}}
    <div class="mt-8 flex justify-center custom-pagination">
        {{ $posts->fragment('senaste')->links('pagination::bootstrap-4') }}
    </div>

    <style>
        /* Hela container-vy */
        .custom-pagination .pagination {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
        }

        /* Alla knappar */
        .custom-pagination .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0 0.75rem;
            font-size: 0.875rem;
            font-weight: 700;
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            background-color: #18181b !important;
            /* bg-zinc-900 */
            color: #a1a1aa !important;
            /* text-zinc-400 */
            text-decoration: none;
            transition: all 0.2s;
        }

        /* Hovring på klickbara knappar */
        .custom-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #27272a !important;
            /* bg-zinc-800 */
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Den AKTIVA sidan (Orange!) */
        .custom-pagination .page-item.active .page-link {
            background-color: #f97316 !important;
            /* bg-orange-500 */
            border-color: #f97316 !important;
            color: #09090b !important;
            /* text-zinc-950 */
        }

        /* Inaktiverade knappar */
        .custom-pagination .page-item.disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
        }
    </style>

    {{-- JavaScript som tvingar webbläsaren att hoppa direkt utan animation --}}
    <script>
        document.querySelectorAll('.custom-pagination a').forEach(link => {
            link.addEventListener('click', () => {
                document.documentElement.style.scrollBehavior = 'auto';
            });
        });
    </script>

</div>

@endsection