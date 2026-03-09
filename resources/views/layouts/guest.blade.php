<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pokémanager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 text-white flex items-center justify-center px-6">

    <div class="max-w-2xl w-full">

        <div class="relative overflow-hidden min-h-screen flex items-center justify-center text-white">

            {{-- Pokéball --}}
            <img
                src="{{ asset('images/pokeball-welcome.png') }}"
                class="absolute left-1/2 -translate-x-1/2 bottom-1/2 translate-y-1/4 w-[700px] pointer-events-none select-none z-0"
                alt="Pokéball logo"
            >

            {{-- Card principale --}}
            <div class="relative z-10 bg-gray-900 border border-white/10 rounded-3xl p-10 shadow-2xl max-w-2xl w-full mx-4">
                {{ $slot }}
            </div>

        </div>

        {{-- Footer --}}
        <p class="text-center text-gray-500 text-sm mt-8">
            ©2026 Pokémanager — Laravel & Tailwind CSS
        </p>

    </div>

    </body>
</html>
