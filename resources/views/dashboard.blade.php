<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Bienvenue {{ Auth::user()->name ?? 'utilisateur' }} !
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = "http://127.0.0.1:8000/pokemons?page=1";
        }, 700);
    </script>
</x-app-layout>
