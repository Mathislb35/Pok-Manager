<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-20 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- Pokémons -->
                <x-nav-link :href="route('pokemons.index')"
                            :active="request()->routeIs('pokemons.*')"
                            class="flex items-center gap-2 font-semibold tracking-wide">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 7l-3 5h3l-2 5 5-7h-3l2-3z" fill="currentColor" stroke="none"/>
                    </svg>
                    Pokémons
                </x-nav-link>

                <!-- Decks -->
                @auth
                <x-nav-link :href="route('decks.index')"
                            :active="request()->routeIs('decks.*')"
                            class="flex items-center gap-2 font-semibold tracking-wide">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm2 4v2h8V6H8z"/>
                    </svg>
                    Decks
                </x-nav-link>
                @endauth
            </div>

            <div class="hidden sm:flex items-center gap-3">
                @auth
                {{-- Utilisateur connecté --}}
                <a href="{{ route('profile.edit') }}"
                   class="bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 transition-all border border-gray-200 dark:border-gray-600">
                    {{ auth()->user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-lg shadow-red-600/20">
                        Déconnexion
                    </button>
                </form>
                @else
                {{-- Visiteur non connecté --}}
                <a href="{{ route('login') }}"
                   class="bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 transition-all border border-gray-200 dark:border-gray-600">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-4 py-2 rounded-lg text-sm font-black transition-all shadow-lg shadow-yellow-400/20">
                    S'inscrire
                </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('pokemons.index')" :active="request()->routeIs('pokemons.*')">
                Pokémons
            </x-responsive-nav-link>

            @auth
            <x-responsive-nav-link :href="route('decks.index')" :active="request()->routeIs('decks.*')">
                Mes Decks
            </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        {{-- Utilisateur connecté --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 mb-3">
                <div class="font-bold text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1 px-4">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
        @else
        {{-- Visiteur non connecté --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
            <div class="space-y-1 px-4">
                <a href="{{ route('login') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold bg-yellow-400 text-gray-900 hover:bg-yellow-300 transition-all text-center">
                    S'inscrire
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>
