@extends('layouts.app')
@section('title', $deck->name)

@section('content')

{{-- Conteneur centré --}}
<div class="max-w-4xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('decks.index') }}" class="hover:text-yellow-400 transition-colors">Mes Decks</a>
        <span>›</span>
        <span class="text-gray-500">{{ $deck->name }}</span>
    </nav>

    {{-- Header Hero --}}
    <div class="border-t border-gray-800 bg-gray-800/50 rounded-3xl p-8 mb-8 relative overflow-hidden">
        {{-- Effet de fond --}}
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-start justify-between gap-6">
            <div class="flex-1">
                {{-- Titre --}}
                <h1 class="text-4xl sm:text-5xl font-display font-black text-white mb-3 leading-tight">
                    {{ $deck->name }}
                </h1>

                @if($deck->description)
                <p class="text-gray-400 text-base mb-4 max-w-xl">{{ $deck->description }}</p>
                @endif

                {{-- Stats --}}
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 bg-gray-800/60 px-4 py-2 rounded-xl">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                        <span class="text-gray-500 text-sm font-semibold">Espèces:</span>
                        <span class="text-white font-black">{{ $deck->pokemons->count() }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-800/60 px-4 py-2 rounded-xl">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"/>
                        </svg>
                        <span class="text-gray-500 text-sm font-semibold">Total:</span>
                        <span class="text-white font-black">{{ $deck->totalCards() }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2 shrink-0">
                <a href="{{ route('decks.edit', $deck) }}"
                   class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-yellow-400/40 text-gray-300 hover:text-yellow-400 px-4 py-2.5 rounded-xl text-sm font-bold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
                <form method="POST" action="{{ route('decks.destroy', $deck) }}" onsubmit="return confirm('Supprimer ce deck ?')">
                    @csrf @method('DELETE')
                    <button class="inline-flex items-center gap-2 bg-red-900/30 hover:bg-red-900/50 border border-red-900/50 hover:border-red-600/50 text-red-400 hover:text-red-300 px-4 py-2.5 rounded-xl text-sm font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Contenu --}}
    @if($deck->pokemons->isEmpty())
    <div class="bg-gray-900 border border-dashed border-gray-700 rounded-2xl p-16 text-center">
        <div class="text-6xl mb-4 opacity-60">🃏</div>
        <p class="text-2xl font-display font-black text-gray-500 mb-2">Deck vide</p>
        <p class="text-sm text-gray-600 mb-6">Commence par ajouter des Pokémons depuis le Pokédex</p>
        <a href="{{ route('pokemons.index') }}"
           class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-6 py-3 rounded-xl font-black transition-all shadow-lg shadow-yellow-400/20 hover:scale-105">
            Parcourir le Pokédex
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>
    @else
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">

        {{-- En-tête de liste --}}
        <div class="px-6 py-5 border-b border-gray-800 bg-gray-800/50">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-yellow-400 rounded-full"></div>
                <div>
                    <h2 class="font-display font-black text-white text-xl">Composition du deck</h2>
                    <p class="text-gray-600 text-xs">Gère tes cartes</p>
                </div>
            </div>
        </div>

        {{-- Liste des Pokémons --}}
        <div class="divide-y divide-gray-800/50">
            @foreach($deck->pokemons as $pokemon)
            <div class="flex items-center gap-5 px-6 py-4 hover:bg-gray-800/30 transition-colors group">

                {{-- Image --}}
                <a href="{{ route('pokemons.show', $pokemon) }}" class="shrink-0">
                    <div class="w-16 h-16 rounded-xl bg-gray-800/50 flex items-center justify-center group-hover:bg-gray-800 transition-colors">
                        <img src="{{ $pokemon->image_url }}" alt="{{ $pokemon->name }}"
                             class="w-14 h-14 object-contain group-hover:scale-110 transition-transform"
                             onerror="this.style.display='none'">
                    </div>
                </a>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ route('pokemons.show', $pokemon) }}"
                       class="font-display font-black text-white text-lg hover:text-yellow-400 transition-colors truncate block mb-1">
                        {{ $pokemon->name }}
                    </a>
                    <div class="flex items-center gap-2">
                                <span class="text-gray-700 text-xs font-mono font-bold">
                                    #{{ str_pad($pokemon->pokedex_number, 3, '0', STR_PAD_LEFT) }}
                                </span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold"
                              style="background: {{ $pokemon->type->color }}20; color: {{ $pokemon->type->color }}; border: 1px solid {{ $pokemon->type->color }}40">
                                    {{ $pokemon->type->name }}
                                </span>
                    </div>
                </div>

                {{-- Quantité --}}
                <form method="POST" action="{{ route('decks.pokemons.update', [$deck, $pokemon]) }}" class="flex items-center gap-2">
                    @csrf @method('PATCH')
                    <span class="text-gray-600 text-xs font-semibold uppercase hidden sm:block">Qté</span>
                    <div class="flex items-center bg-gray-800 border border-gray-700 rounded-xl overflow-hidden hover:border-yellow-400/40 transition-colors">
                        <button type="button"
                                onclick="this.nextElementSibling.stepDown(); this.closest('form').requestSubmit()"
                                class="px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-700 transition-colors font-bold text-base w-10 flex items-center justify-center">
                            −
                        </button>
                        <input type="number"
                               name="quantity"
                               value="{{ $pokemon->pivot->quantity }}"
                               min="1"
                               max="99"
                               class="w-14 bg-transparent text-white text-center font-bold focus:outline-none"
                               onchange="this.form.requestSubmit()">
                        <button type="button"
                                onclick="this.previousElementSibling.stepUp(); this.closest('form').requestSubmit()"
                                class="px-3 py-2.5 text-gray-400 hover:text-white hover:bg-gray-700 transition-colors font-bold text-base w-10 flex items-center justify-center">
                            +
                        </button>
                    </div>
                </form>

                {{-- Supprimer --}}
                <form method="POST" action="{{ route('decks.pokemons.destroy', [$deck, $pokemon]) }}"
                      onsubmit="return confirm('Retirer {{ $pokemon->name }} du deck ?')">
                    @csrf @method('DELETE')
                    <button class="group-hover:opacity-100 w-9 h-9 flex items-center justify-center text-gray-600 hover:text-red-400 transition-all rounded-lg hover:bg-red-900/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="px-6 py-5 border-t border-gray-800 bg-gray-800/50 flex justify-between items-center">
            <span class="text-gray-500 font-bold uppercase tracking-wider text-xs">Total des cartes</span>
            <div class="flex items-center gap-2">
                <span class="text-yellow-400 font-black text-2xl">{{ $deck->totalCards() }}</span>
                <span class="text-yellow-400/60 text-sm font-semibold">cartes</span>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection
