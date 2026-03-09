<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\DeckPokemonController;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════════════════
// PAGE D'ACCUEIL (tout le monde arrive ici)
// ═══════════════════════════════════════════════════════════
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ═══════════════════════════════════════════════════════════
// POKÉMONS (accessible à TOUS, connecté ou non)
// ═══════════════════════════════════════════════════════════
Route::resource('pokemons', PokemonController::class);

// ═══════════════════════════════════════════════════════════
// ROUTES AUTHENTIFIÉES
// ═══════════════════════════════════════════════════════════
Route::middleware('auth')->group(function () {

    // Dashboard → redirige vers pokemons.index
    Route::get('/dashboard', function () {
        return redirect()->route('pokemons.index');
    })->name('dashboard');

    // ───────────────────────────────────────────────────────
    // DECKS (uniquement pour utilisateurs connectés)
    // ───────────────────────────────────────────────────────
    Route::get('decks', [DeckController::class, 'index'])->name('decks.index');
    Route::post('decks', [DeckController::class, 'store'])->name('decks.store');
    Route::get('decks/{deck}', [DeckController::class, 'show'])->name('decks.show');
    Route::get('decks/{deck}/edit', [DeckController::class, 'edit'])->name('decks.edit');
    Route::put('decks/{deck}', [DeckController::class, 'update'])->name('decks.update');
    Route::delete('decks/{deck}', [DeckController::class, 'destroy'])->name('decks.destroy');

    // Gestion des Pokémons dans les decks
    Route::post('decks/{deck}/pokemons', [DeckPokemonController::class, 'store'])
        ->name('decks.pokemons.store');
    Route::patch('decks/{deck}/pokemons/{pokemon}', [DeckPokemonController::class, 'update'])
        ->name('decks.pokemons.update');
    Route::delete('decks/{deck}/pokemons/{pokemon}', [DeckPokemonController::class, 'destroy'])
        ->name('decks.pokemons.destroy');

    // ───────────────────────────────────────────────────────
    // PROFIL UTILISATEUR (Breeze)
    // ───────────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
