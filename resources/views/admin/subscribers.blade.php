@extends('/dashboard')

@section('title', 'Prenumeranter – MC Bloggen')

@section('admin-content')

<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="h-0.5 w-6 bg-orange-500"></span>

                <span class="text-xs font-bold uppercase tracking-[0.2em] text-orange-500">
                    Nyhetsbrev
                </span>
            </div>

            <h1 class="text-3xl font-bold text-white">
                Prenumeranter
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Här kan du se och hantera alla som prenumererar på nyhetsbrevet.
            </p>
        </div>


        <!-- Tillbaka -->
        <a
            href="{{ route('admin.index') }}"
            class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-500 transition">

            <svg
                class="w-4 h-4 mr-1.5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            Tillbaka till inlägg
        </a>

    </div>


    <!-- Meddelande -->
    @if(session('success'))

    <div class="mb-6 rounded-lg border border-green-500/20 bg-green-500/10 px-4 py-3">

        <p class="text-sm text-green-400">
            {{ session('success') }}
        </p>

    </div>

    @endif


    <!-- Lista -->
    <div class="bg-zinc-800 rounded-lg shadow-xl overflow-hidden">

        <!-- Topplinje -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-700">

            <div>

                <h2 class="text-lg font-semibold text-white">
                    Alla prenumeranter
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    {{ $subscribers->total() }}
                    {{ $subscribers->total() === 1 ? 'prenumerant' : 'prenumeranter' }}
                    totalt
                </p>

            </div>

        </div>


        @if($subscribers->count() > 0)

        <!-- Tabell -->
        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-zinc-900/70 border-b border-zinc-700">

                    <tr>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-400">
                            E-postadress
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-400">
                            Prenumererade
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-400 text-right">
                            Åtgärd
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-zinc-700">

                    @foreach($subscribers as $subscriber)

                    <tr class="hover:bg-zinc-750 transition">

                        <!-- E-post -->
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-orange-500/10 text-orange-500">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>

                                </div>

                                <span class="text-sm font-medium text-white">
                                    {{ $subscriber->email }}
                                </span>

                            </div>

                        </td>


                        <!-- Datum -->
                        <td class="px-6 py-4">

                            <span class="text-sm text-gray-400">
                                {{ $subscriber->created_at->format('Y-m-d H:i') }}
                            </span>

                        </td>


                        <!-- Ta bort -->
                        <td class="px-6 py-4 text-right">

                            <form
                                action="{{ route('admin.newsletter.destroy', $subscriber) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Är du säker på att du vill ta bort denna prenumerant?');">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-400 hover:text-red-400 transition">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>

                                    Ta bort

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <!-- Pagination -->
        @if($subscribers->hasPages())

        <div class="px-6 py-4 border-t border-zinc-700">
            {{ $subscribers->links() }}
        </div>

        @endif

        @else

        <!-- Tom lista -->
        <div class="px-6 py-16 text-center">

            <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-full bg-zinc-900 text-gray-600">

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 00-2 2z" />
                </svg>

            </div>

            <h3 class="mt-4 text-sm font-semibold text-white">
                Inga prenumeranter ännu
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                Det finns ännu ingen som prenumererar på nyhetsbrevet.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection