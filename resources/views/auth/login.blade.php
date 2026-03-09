<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-guest-layout>

    {{-- En-tête --}}
    <div class="mb-8 text-center">
        <h1 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent mb-3">
            Connexion
        </h1>
        <p class="text-gray-400 text-sm">
            Accède à ton Pokédex et gère tes decks
        </p>
    </div>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-semibold" />
            <x-text-input id="email"
                          class="block mt-2 w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 rounded-xl py-3 px-4"
                          type="email"
                          name="email"
                          :value="old('email')"
                          placeholder="ton@email.com"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- Mot de passe --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-300 font-semibold" />
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs text-gray-500 hover:text-yellow-400 transition-colors underline">
                    Mot de passe oublié ?
                </a>
                @endif
            </div>
            <x-text-input id="password"
                          class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500
                                 focus:border-yellow-400 focus:ring-yellow-400 rounded-xl py-3 px-4"
                          type="password"
                          name="password"
                          placeholder="••••••••"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
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
                Se connecter
            </button>

        </div>

        {{-- Lien inscription --}}
        <div class="text-center pt-4 border-t border-white/10">
            <p class="text-gray-400 text-sm">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                    S'inscrire
                </a>
            </p>
        </div>
    </form>

</x-guest-layout>

