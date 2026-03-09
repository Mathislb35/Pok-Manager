@extends('layouts.app')
@section('title', $pokemon->name)
@section('content')



{{-- ════════════════════════════════════════════════════════════════════════════════
CONTENU PRINCIPAL - LAYOUT CENTRÉ
Carte du Pokémon avec portrait et stats sur une largeur max de 1200px
════════════════════════════════════════════════════════════════════════════════ --}}
<div class="max-w-6xl mx-auto">
    {{-- ════════════════════════════════════════════════════════════════════════════════
    NAVIGATION ENTRE POKÉMONS
    ════════════════════════════════════════════════════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 mb-8 mt-10">
        @php
        $prev = \App\Models\Pokemon::where('pokedex_number', '<', $pokemon->pokedex_number)
        ->orderBy('pokedex_number', 'desc')
        ->first();

        $next = \App\Models\Pokemon::where('pokedex_number', '>', $pokemon->pokedex_number)
        ->orderBy('pokedex_number', 'asc')
        ->first();
        @endphp

        {{-- Bouton Précédent --}}
        @if($prev)
        <a href="{{ route('pokemons.show', $prev) }}"
           class="flex items-center gap-2 bg-gray-900 hover:bg-gray-800 border border-gray-800 hover:border-yellow-400/40 text-gray-400 hover:text-yellow-400 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="hidden sm:inline">{{ $prev->name }}</span>
            <span class="sm:hidden">#{{ str_pad($prev->pokedex_number, 3, '0', STR_PAD_LEFT) }}</span>
        </a>
        @else
        <div></div>
        @endif

        {{-- Bouton Retour à l'accueil (Pokédex) --}}
        <a href="{{ route('pokemons.index') }}"
           class="flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-5 py-2.5 rounded-xl text-sm font-black transition-all shadow-lg shadow-yellow-400/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="hidden sm:inline">Pokédex</span>
        </a>

        {{-- Bouton Suivant --}}
        @if($next)
        <a href="{{ route('pokemons.show', $next) }}"
           class="flex items-center gap-2 bg-gray-900 hover:bg-gray-800 border border-gray-800 hover:border-yellow-400/40 text-gray-400 hover:text-yellow-400 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all group">
            <span class="hidden sm:inline">{{ $next->name }}</span>
            <span class="sm:hidden">#{{ str_pad($next->pokedex_number, 3, '0', STR_PAD_LEFT) }}</span>
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @else
        <div></div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- ════════════════════════════════════════════════════════════════════════
        COLONNE GAUCHE : PORTRAIT DU POKÉMON
        Image, nom, types et infos générales
        ════════════════════════════════════════════════════════════════════════ --}}
        <div>
            <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden sticky top-24">

                {{-- En-tête : Numéro Pokédex + Badge Légendaire --}}
                <div class="flex items-center justify-between px-6 pt-6">
                    <span class="text-gray-700 text-sm font-mono font-bold">
                        #{{ str_pad($pokemon->pokedex_number, 3, '0', STR_PAD_LEFT) }}
                    </span>
                    @if($pokemon->is_legendary)
                    <span class="bg-yellow-400/10 border border-yellow-400/30 text-yellow-400 text-xs font-bold px-3 py-1 rounded-full">
                            ✨ Légendaire ✨
                        </span>
                    @endif
                </div>

                {{-- Zone d'image avec fond coloré gradient --}}
                <div class="relative py-10 px-8 flex items-center justify-center min-h-72">
                    {{-- Gradient radial aux couleurs du type principal --}}
                    <div class="absolute inset-0"
                         style="background: radial-gradient(ellipse at 50% 80%, {{ $pokemon->type->color }}30 40%, transparent 80%)">
                    </div>

                    {{-- Image du Pokémon --}}
                    <img src="{{ $pokemon->image_url }}"
                         alt="{{ $pokemon->name }}"
                         class="relative z-10 w-60 h-60 object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">

                    {{-- Fallback si l'image ne charge pas : affiche les 2 premières lettres --}}
                    <div class="w-60 h-60 hidden items-center justify-center text-9xl font-display font-black text-gray-800">
                        {{ strtoupper(mb_substr($pokemon->name, 0, 2)) }}
                    </div>
                </div>

                {{-- Nom, types et infos --}}
                <div class="px-6 pb-6 text-center">
                    {{-- Nom du Pokémon --}}
                    <h1 class="text-4xl font-display font-black text-white mb-4">
                        {{ $pokemon->name }}
                    </h1>

                    {{-- Badges de types --}}
                    <div class="flex justify-center gap-2 mb-6">
                        {{-- Type principal --}}
                        <span class="px-4 py-1.5 rounded-full text-sm font-bold uppercase"
                              style="background: {{ $pokemon->type->color }}22;
                                     color: {{ $pokemon->type->color }};
                                     border: 1px solid {{ $pokemon->type->color }}55">
                            {{ $pokemon->type->name }}
                        </span>

                        {{-- Type secondaire (s'il existe) --}}
                        @if($pokemon->type2)
                        <span class="px-4 py-1.5 rounded-full text-sm font-bold uppercase"
                              style="background: {{ $pokemon->type2->color }}22;
                                         color: {{ $pokemon->type2->color }};
                                         border: 1px solid {{ $pokemon->type2->color }}55">
                                {{ $pokemon->type2->name }}
                            </span>
                        @endif
                    </div>

                    {{-- Infos rapides : Génération --}}
                    <div class="grid gap-3">
                        <div class="bg-gray-800/60 rounded-xl p-4">
                            <p class="text-gray-600 text-xs uppercase tracking-wider mb-1">Génération</p>
                            <p class="text-white font-bold text-lg">{{ $pokemon->generation }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════════════════════════════════════════════════════════════════════
        COLONNE DROITE : STATISTIQUES
        Barres de progression pour chaque stat
        ════════════════════════════════════════════════════════════════════════ --}}
        <div class="flex mt-28 flex-col gap-6">
            {{-- Carte des statistiques --}}
            <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8">
                {{-- Titre de la section --}}
                <h2 class="font-display font-bold text-white text-xl mb-8 flex items-center gap-3">
                    {{-- Barre colorée aux couleurs du type --}}
                    <span class="w-1 h-7 rounded-full" style="background: {{ $pokemon->type->color }}"></span>
                    Statistiques
                </h2>

                {{-- Liste des stats avec barres de progression --}}
                <div class="space-y-5">
                    {{-- HP (Points de Vie) --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">HP</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->hp }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #22C55E"
                                 data-width="{{ round(($pokemon->hp / 255) * 100) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Attaque --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">Attaque</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->attack }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #F97316"
                                 data-width="{{ round(($pokemon->attack / 255) * 100) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Défense --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">Défense</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->defense }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #3B82F6"
                                 data-width="{{ round(($pokemon->defense / 255) * 100) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Attaque Spéciale --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">Atk. Spé.</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->sp_attack }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #A855F7"
                                 data-width="{{ round(($pokemon->sp_attack / 255) * 100) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Défense Spéciale --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">Déf. Spé.</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->sp_defense }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #06B6D4"
                                 data-width="{{ round(($pokemon->sp_defense / 255) * 100) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Vitesse --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-500 text-sm font-semibold w-28">Vitesse</span>
                        <span class="text-white font-bold text-sm w-12 text-right">{{ $pokemon->speed }}</span>
                        <div class="flex-1 h-3 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full stat-bar transition-all duration-1000"
                                 style="width: 0%; background: #EAB308"
                                 data-width="{{ round(($pokemon->speed / 255) * 100) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
            @auth
            <div class="mt-5 bg-gray-900 border border-gray-800 rounded-3xl p-8">
                <h2 class="font-display font-bold text-white text-xl mb-6 flex items-center gap-3">
                    <span class="w-1 h-7 rounded-full bg-yellow-400"></span>
                    Gérer tes decks
                </h2>

                @php
                $userDecks = auth()->user()->decks()->get();
                @endphp

                @if($userDecks->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        {{-- Colonne gauche : Ajouter à un deck existant --}}
                        <div class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700">
                            <h3 class="text-white font-display font-bold text-lg mb-4">
                                Ajouter ce pokemon à un deck existant
                            </h3>

                            <form method="POST" id="add-to-deck-form" class="space-y-4">
                                @csrf
                                <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">

                                {{-- Sélecteur de deck --}}
                                <div>
                                    <label class="block text-gray-500 text-xs font-semibold mb-2 uppercase">
                                        Choisir un deck
                                    </label>
                                    <select name="deck_id" id="deck-selector"
                                            class="w-full bg-gray-800 border border-gray-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-yellow-400 cursor-pointer">
                                        @foreach($userDecks as $deck)
                                        <option value="{{ $deck->id }}">
                                            {{ $deck->name }} ({{ $deck->pokemons->count() }} Pokémons)
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Quantité --}}
                                <div>
                                    <label class="block text-gray-500 text-xs font-semibold mb-2 uppercase">
                                        Quantité
                                    </label>
                                    <div class="flex items-center gap-3 bg-gray-800 border border-gray-700 rounded-xl px-4 py-3">
                                        <button type="button" onclick="changeQty(-1)"
                                                class="text-gray-400 hover:text-white font-bold text-lg w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-700 transition-colors">
                                            −
                                        </button>
                                        <input type="number" name="quantity" id="qty-input" value="1" min="1" max="99"
                                               class="flex-1 bg-transparent text-white text-center font-bold focus:outline-none">
                                        <button type="button" onclick="changeQty(1)"
                                                class="text-gray-400 hover:text-white font-bold text-lg w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-700 transition-colors">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="w-full bg-yellow-400 hover:bg-yellow-300 text-gray-900 py-3 rounded-xl font-black transition-all shadow-lg shadow-yellow-400/20">
                                    Ajouter au deck
                                </button>
                            </form>
                        </div>

                        {{-- Colonne droite : Créer un nouveau deck --}}
                        <div class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700">
                            <h3 class="text-white font-display font-bold text-lg mb-4">
                                Créer un nouveau deck
                            </h3>

                            <form method="POST" action="{{ route('decks.store') }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                                <input type="hidden" name="quantity" value="1">

                                {{-- Nom du nouveau deck --}}
                                <div>
                                    <label class="block text-gray-500 text-xs font-semibold mb-2 uppercase">
                                        Nom du deck
                                    </label>
                                    <input type="text"
                                           name="name"
                                           placeholder="Ex: Mon deck Feu"
                                           required
                                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-yellow-400 placeholder-gray-600">
                                </div>

                                {{-- Description (optionnel) --}}
                                <div>
                                    <label class="block text-gray-500 text-xs font-semibold mb-2 uppercase">
                                        Description (optionnel)
                                    </label>
                                    <textarea name="description"
                                              rows="2"
                                              placeholder="Décris ta stratégie..."
                                              class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-yellow-400 placeholder-gray-600 resize-none"></textarea>
                                </div>

                                <button type="submit"
                                        class="w-full bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-yellow-400 text-gray-300 hover:text-white py-3 rounded-xl font-bold transition-all">
                                    Créer et ajouter
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Si aucun deck --}}
                    @else
                    <div class="text-center py-10">
                        <div class="text-5xl mb-4">🃏</div>
                        <p class="text-gray-500 mb-6">Tu n'as pas encore de deck !</p>

                        <form method="POST" action="{{ route('decks.store') }}" class="max-w-md mx-auto space-y-4">
                            @csrf
                            <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                            <input type="hidden" name="quantity" value="1">

                            <input type="text"
                                   name="name"
                                   placeholder="Nom du deck (ex: Mon deck Feu)"
                                   required
                                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-yellow-400 placeholder-gray-600">

                            <button type="submit"
                                    class="w-full bg-yellow-400 hover:bg-yellow-300 text-gray-900 py-3 rounded-xl font-black transition-all shadow-lg shadow-yellow-400/20">
                                Créer mon premier deck
                            </button>
                        </form>
                    </div>
                    @endif
            </div>

            <script>
                function changeQty(delta) {
                    const input = document.getElementById('qty-input');
                    input.value = Math.max(1, Math.min(99, parseInt(input.value || 1) + delta));
                }

                document.getElementById('deck-selector')?.addEventListener('change', function() {
                    document.getElementById('add-to-deck-form').action = '/decks/' + this.value + '/pokemons';
                });

                // Init de l'action au chargement
                const selector = document.getElementById('deck-selector');
                if (selector) {
                    document.getElementById('add-to-deck-form').action = '/decks/' + selector.value + '/pokemons';
                }
            </script>
            @endauth

            {{-- ════════════════════════════════════════════════════════════════
            CTA CONNEXION (visible uniquement si non connecté)
            Incite à créer un compte pour gérer des decks
            ════════════════════════════════════════════════════════════════ --}}
            @guest
            <div class="bg-gray-900/50 border border-dashed border-gray-700 rounded-2xl p-6 text-center">
                <p class="text-gray-500 mb-4 text-sm">Connecte-toi pour gérer tes decks Pokémon</p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('login') }}"
                       class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 px-5 py-2 rounded-xl text-sm font-semibold transition-all">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-5 py-2 rounded-xl text-sm font-black transition-all">
                        S'inscrire
                    </a>
                </div>
            </div>
            @endguest
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════════════════════════════
ANIMATION DES BARRES DE STATS
Les barres s'animent progressivement quand elles entrent dans le viewport
════════════════════════════════════════════════════════════════════════════════ --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Sélectionne toutes les barres de stats
        const bars = document.querySelectorAll('.stat-bar[data-width]');

        // Intersection Observer pour détecter quand les barres sont visibles
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    // Petit délai avant de démarrer l'animation
                    setTimeout(() => {
                        bar.style.width = bar.dataset.width + '%';
                    }, 150);
                    // Stop d'observer cette barre une fois animée
                    observer.unobserve(bar);
                }
            });
        }, {
            threshold: 0.2 // Se déclenche quand 20% de l'élément est visible
        });

        // Lance l'observation de chaque barre
        bars.forEach(bar => observer.observe(bar));
    });
</script>
@endsection
