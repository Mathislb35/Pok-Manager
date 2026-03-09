<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Decks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@extends('layouts.app')
@section('title', 'Mes Decks')

@section('content')

{{-- Conteneur centré --}}
<div class="max-w-5xl mx-auto mt-10">

    {{-- Hero Header --}}
    <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden mb-8">
        {{-- Contenu principal du hero --}}
        <div class="p-8 relative">
            {{-- Effet de fond --}}
            <div class="absolute inset-0 border-gray-800/50"></div>
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-yellow-400/10 border border-yellow-400/30 text-yellow-400 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                        Ma Collection
                    </div>

                    {{-- Titre principal --}}
                    <h1 class="text-4xl sm:text-5xl font-display font-black text-white leading-tight mb-2">
                        Mes Decks
                    </h1>

                    {{-- Stats --}}
                    <div class="flex items-center gap-3 text-sm">
                        <div class="flex items-center gap-2 bg-gray-800/60 px-3 py-1.5 rounded-lg">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"/>
                            </svg>
                            <span class="text-gray-400 font-semibold">{{ $decks->count() }}</span>
                            <span class="text-gray-600">deck{{ $decks->count() > 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Bouton créer (si au moins 1 deck existe) --}}
                @if($decks->count() > 0)
                <a href="{{ route('pokemons.index') }}"
                   class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-5 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-yellow-400/20 hover:scale-105 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter des Pokémons
                </a>
                @endif
            </div>
        </div>

        {{-- Footer avec border-top --}}
        <div class="border-t border-gray-800 bg-gray-800/50 px-8 py-4">
            <p class="text-gray-600 text-sm text-center">
                @if($decks->isEmpty())
                Commence par parcourir le Pokédex pour créer ton premier deck
                @else
                Gère tes decks et ajoute de nouveaux Pokémons depuis le Pokédex
                @endif
            </p>
        </div>
    </div>

    {{-- Liste des decks --}}
    @if($decks->isEmpty())
    <div class="bg-gray-900 border border-dashed border-gray-700 rounded-2xl p-20 text-center">
        <div class="text-7xl mb-6 opacity-60">🃏</div>
        <p class="text-2xl font-display font-black text-gray-500 mb-2">Aucun deck pour l'instant</p>
        <p class="text-sm text-gray-600 mb-8">Commence par parcourir le Pokédex et crée ton premier deck</p>
        <a href="{{ route('pokemons.index') }}"
           class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-6 py-3 rounded-xl font-black transition-all shadow-lg shadow-yellow-400/20 hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Parcourir le Pokédex
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($decks as $deck)
        <div class="group bg-gray-900 border border-gray-800 hover:border-yellow-400/40 rounded-2xl overflow-hidden transition-all hover:shadow-lg hover:shadow-yellow-400/5 hover:scale-[1.02]">

            {{-- Preview des Pokémons --}}
            <div class="h-36 bg-gradient-to-br from-gray-800/50 to-gray-800/30 relative overflow-hidden flex items-center justify-center gap-1 px-4">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-gray-900"></div>

                @if($deck->pokemons->isEmpty())
                <div class="text-gray-700 text-5xl z-10 opacity-50">🃏</div>
                @else
                @foreach($deck->pokemons->take(4) as $pokemon)
                <img src="{{ $pokemon->image_url }}"
                     alt="{{ $pokemon->name }}"
                     class="h-20 w-20 object-contain drop-shadow-2xl z-10 group-hover:scale-110 transition-transform"
                     style="margin-left: {{ $loop->index > 0 ? '-1rem' : '0' }}"
                     onerror="this.style.display='none'">
                @endforeach
                @endif
            </div>

            {{-- Infos du deck --}}
            <div class="p-5">
                <h2 class="text-xl font-display font-black text-white mb-1 group-hover:text-yellow-400 transition-colors truncate">
                    {{ $deck->name }}
                </h2>

                @if($deck->description)
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $deck->description }}</p>
                @endif

                <div class="flex items-center gap-3 text-sm mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                        <span class="text-gray-600">
                                    <span class="text-white font-bold">{{ $deck->pokemons->count() }}</span> espèce{{ $deck->pokemons->count() > 1 ? 's' : '' }}
                                </span>
                    </div>
                    <span class="text-gray-800">•</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"/>
                        </svg>
                        <span class="text-gray-600">
                                    <span class="text-yellow-400 font-bold">{{ $deck->totalCards() }}</span> cartes
                                </span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <a href="{{ route('decks.show', $deck) }}"
                       class="flex-1 text-center bg-gray-800 hover:bg-yellow-400 hover:text-gray-900 border border-gray-700 hover:border-yellow-400 text-gray-300 py-2.5 rounded-xl text-sm font-bold transition-all">
                        Voir le deck
                    </a>
                    <a href="{{ route('decks.edit', $deck) }}"
                       class="p-2.5 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-500 hover:text-yellow-400 rounded-xl transition-all"
                       title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('decks.destroy', $deck) }}"
                          onsubmit="return confirm('Supprimer le deck {{ addslashes($deck->name) }} ?')">
                        @csrf @method('DELETE')
                        <button class="p-2.5 bg-gray-800 hover:bg-red-900/40 border border-gray-700 hover:border-red-700 text-gray-500 hover:text-red-400 rounded-xl transition-all"
                                title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

@endsection
