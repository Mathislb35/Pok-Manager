<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémanager</title>
    <!-- Icone Pokéball -->
    <link rel="icon" type="image/png" href="{{ asset('images/pokeball.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 text-white flex items-center justify-center px-6">

<div class="max-w-2xl w-full">

    <div class="relative overflow-hidden min-h-screen flex items-center justify-center text-white">

        <!-- Pokéball-->
            <img
                src="{{ asset('images/pokeball-welcome.png') }}"
                class="absolute left-1/2 -translate-x-1/2 bottom-1/2 translate-y-1/4 w-[700px] pointer-events-none select-none z-0"
                alt="Pokéball logo"
            >


        <!-- Card principale -->
        <div class="relative z-10 bg-gray-900 border border-white/10
            rounded-3xl p-10 shadow-2xl text-center max-w-2xl w-full mx-4">

            <h1 class="text-5xl md:text-6xl font-black tracking-tight mb-6
                   bg-gradient-to-r from-yellow-400 to-orange-500
                   bg-clip-text text-transparent">
                Bienvenue dans Pokémanager !
            </h1>

            <p class="text-gray-300 text-lg mb-10 leading-relaxed">
                Explorez, consultez et gérez votre collection de Pokémon
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <a href="{{ route('login') }}"
                   class="px-8 py-3 rounded-xl font-semibold
                      bg-yellow-500 hover:bg-yellow-400
                      text-gray-900 transition-all duration-300
                      hover:scale-105 shadow-lg">
                    Se connecter
                </a>

                <a href="{{ route('register') }}"
                   class="px-8 py-3 rounded-xl font-semibold
                      border border-white/20
                      hover:border-yellow-400
                      hover:text-yellow-400
                      transition-all duration-300
                      hover:scale-105">
                    S'inscrire
                </a>

                <a href="{{ route('pokemons.index') }}"
                   class="px-8 py-3 rounded-xl font-semibold
                      border border-white/20
                      hover:border-yellow-400
                      hover:text-yellow-400
                      transition-all duration-300
                      hover:scale-105">
                    Voir tous les Pokémons
                </a>

            </div>


        </div>

    </div>
    <p class="text-center text-gray-500 text-sm mt-8">
        ©2026 Pokémanager — Laravel & Tailwind CSS
    </p>

</div>

</body>
</html>
