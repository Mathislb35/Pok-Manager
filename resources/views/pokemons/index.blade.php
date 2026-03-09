<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokédex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-black text-4xl text-white leading-tight">
            Pokédex
        </h2>
        <p class="text-gray-400 mt-1 text-sm">
            Vous avez : {{ $pokemons->total() }} pokémons
        </p>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">
        <form method="GET" action="{{ route('pokemons.index') }}"
              class="bg-gray-900/70 backdrop-blur border border-gray-800 rounded-2xl p-5">

            <div class="flex flex-col sm:flex-row gap-3">

                {{-- Barre de recherche --}}
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-600 pointer-events-none"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher un Pokémon..."
                           class="w-full bg-gray-800 border border-gray-700 text-white placeholder-gray-600
                              rounded-xl pl-11 pr-4 py-3 text-sm
                              focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                </div>

                {{-- Filtre Type --}}
                <select name="type"
                        class="bg-gray-800 border border-gray-700 text-gray-300 rounded-xl
               px-5 py-3 text-sm focus:outline-none focus:border-yellow-400
               focus:ring-2 focus:ring-yellow-400/20 transition-all cursor-pointer
               hover:border-gray-600 sm:w-48
               [&>option]:bg-gray-800 [&>option]:text-gray-300 [&>option]:rounded-lg [&>option]:py-2">
                    <option value="">Tous les types</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                    {{ $type->display_name }}
                    </option>
                    @endforeach
                </select>

                {{-- Bouton Filtrer --}}
                <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-6 py-3
                           rounded-xl text-sm font-black transition-all
                           shadow-lg shadow-yellow-400/10 hover:shadow-yellow-400/20
                           hover:scale-105 active:scale-95 whitespace-nowrap">
                    Filtrer
                </button>

                {{-- Bouton Reset --}}
                @if(request()->hasAny(['search','type']))
                <a href="{{ route('pokemons.index') }}"
                   class="flex items-center justify-center gap-2 text-gray-500 hover:text-gray-300
                          px-4 py-3 text-sm transition-colors group rounded-xl hover:bg-gray-800"
                   title="Réinitialiser">
                    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-300"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span class="hidden sm:inline">Reset</span>
                </a>
                @endif
            </div>
        </form>
    </div>


    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 mb-10 [grid-template-columns:repeat(auto-fit,minmax(200px,1fr))]">
            @foreach($pokemons as $pokemon)
            <a href="{{ route('pokemons.show', $pokemon) }}"
               class="pokemon-card group bg-gray-900 border border-gray-800 hover:border-yellow-400/50
                              rounded-2xl overflow-hidden block">

                {{-- Image --}}
                <div class="relative h-28 sm:h-32 flex items-center justify-center px-4 pt-4 pb-2">
                    <img src="{{ $pokemon->image_url }}"
                         alt="{{ $pokemon->name }}"
                         loading="lazy"
                         class="h-20 sm:h-24 w-auto object-contain relative z-10
                                        group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                </div>

                {{-- Infos --}}
                <div class="px-3 pb-4 text-center">
                    <p class="text-gray-700 text-xs font-mono">
                        #{{ str_pad($pokemon->pokedex_number, 3, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="font-display font-bold text-white text-sm truncate mt-0.5">
                        {{ $pokemon->name }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @include('pokemons.pagination', ['pokemons' => $pokemons])

    </div>
</x-app-layout>
