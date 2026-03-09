<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-guest-layout>

    {{-- En-tête --}}
    <div class="mb-8 text-center">
        <h1 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent mb-3">
            Créer un compte
        </h1>
        <p class="text-gray-400 text-sm">
            Rejoins le Pokédex et crée ton équipe de rêve
        </p>
    </div>

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nom --}}
        <div>
            <x-input-label for="name" :value="__('Nom')" class="text-gray-300 font-semibold" />
            <x-text-input id="name"
                          class="block mt-2 w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-yellow-400 rounded-xl py-3 px-4"
                          type="text"
                          name="name"
                          :value="old('name')"
                          placeholder="Ton pseudo"
                          required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-semibold" />
            <x-text-input id="email"
                          class="block mt-2 w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-yellow-400 rounded-xl py-3 px-4"
                          type="email"
                          name="email"
                          :value="old('email')"
                          placeholder="ton@email.com"
                          required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- Mot de passe --}}
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-300 font-semibold" />
            <x-text-input id="password"
                          class="block mt-2 w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-yellow-400 rounded-xl py-3 px-4"
                          type="password"
                          name="password"
                          placeholder="••••••••"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- Confirmation mot de passe --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-300 font-semibold" />
            <x-text-input id="password_confirmation"
                          class="block mt-2 w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-yellow-400 rounded-xl py-3 px-4"
                          type="password"
                          name="password_confirmation"
                          placeholder="••••••••"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4">

            <a href="{{ url('/') }}"
               class="w-full sm:w-auto text-center bg-gray-800/50 hover:bg-gray-800 border border-gray-700 text-gray-300 hover:text-white px-6 py-3 rounded-xl font-semibold transition-all">
                ← Retour
            </a>

            <button type="submit"
                    class="w-full sm:w-auto px-8 py-3 rounded-xl font-black
                           bg-yellow-500 hover:bg-yellow-400
                           text-gray-900 transition-all duration-300
                           hover:scale-105 shadow-lg shadow-yellow-500/20">
                S'inscrire
            </button>

        </div>

        {{-- Lien connexion --}}
        <div class="text-center pt-4 border-t border-white/10">
            <p class="text-gray-400 text-sm">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                    Se connecter
                </a>
            </p>
        </div>
    </form>
    <p class="text-center text-gray-500 text-sm mt-8">
        ©2026 Pokémanager — Laravel & Tailwind CSS
    </p>

</x-guest-layout>
