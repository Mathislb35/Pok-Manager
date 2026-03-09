@if($pokemons->hasPages())
<div class="flex flex-col items-center gap-4 mt-10">

    <div class="text-sm text-gray-500">
        Affichage de
        <span class="font-semibold text-gray-300">{{ $pokemons->firstItem() }}</span>
        à
        <span class="font-semibold text-gray-300">{{ $pokemons->lastItem() }}</span>
        pokémons sur
        <span class="font-semibold text-yellow-400">{{ $pokemons->total() }}</span>
    </div>

    <nav class="flex items-center gap-2">

        @php
        $current = $pokemons->currentPage();
        $last = $pokemons->lastPage();

        // Calcul de la fenêtre de 3 pages
        if ($current == 1) {
        $start = 1;
        $end = min(3, $last);
        } elseif ($current == $last) {
        $start = max(1, $last - 2);
        $end = $last;
        } else {
        $start = $current - 1;
        $end = min($last, $current + 1);
        }
        @endphp

        {{-- Icône de première page --}}
        @if($current > 1)
        <a href="{{ $pokemons->url(1) }}"
           class="px-3 py-2 text-gray-400 hover:text-yellow-400 transition-colors"
           title="Première page">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
            </svg>
        </a>
        @endif

        {{-- Précédent (n'apparaît que s'il y a une page précédente) --}}
        @if(!$pokemons->onFirstPage())
        <a href="{{ $pokemons->previousPageUrl() }}" title="Précédent"
           class="px-3 py-2 text-gray-400 hover:text-yellow-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        @endif

        {{-- Les 3 pages de la fenêtre --}}
        @for($page = $start; $page <= $end; $page++)
        @if($page == $current)
        <span class="min-w-[2.5rem] h-10 flex items-center justify-center bg-yellow-400 text-gray-900 rounded-xl text-sm font-black shadow-lg shadow-yellow-400/20">
                {{ $page }}
            </span>
        @else
        <a href="{{ $pokemons->url($page) }}"
           class="min-w-[2.5rem] h-10 flex items-center justify-center bg-gray-800 border border-gray-700 hover:bg-yellow-400 hover:border-yellow-400 text-gray-300 hover:text-gray-900 rounded-xl text-sm font-bold transition-all">
            {{ $page }}
        </a>
        @endif
        @endfor

        {{-- Suivant (n'apparaît que s'il y a une page suivante) --}}
        @if($pokemons->hasMorePages())
        <a href="{{ $pokemons->nextPageUrl() }}"
           class="px-3 py-2 text-gray-400 hover:text-yellow-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endif

        {{-- Icône de dernière page --}}
        @if($current < $last)
        <a href="{{ $pokemons->url($last) }}"
           class="px-3 py-2 text-gray-400 hover:text-yellow-400 transition-colors"
           title="Dernière page">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
            </svg>
        </a>
        @endif
    </nav>
</div>
@endif
