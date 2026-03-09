<?php
namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Pokemon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeckPokemonController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function store(Request $request, Deck $deck): RedirectResponse
    {
        $this->authorize('update', $deck);

        $request->validate([
            'pokemon_id' => 'required|exists:pokemons,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $existing = $deck->pokemons()->where('pokemon_id', $request->pokemon_id)->first();

        if ($existing) {
            $deck->pokemons()->updateExistingPivot($request->pokemon_id, [
                'quantity' => $existing->pivot->quantity + $request->quantity,
            ]);
        } else {
            $deck->pokemons()->attach($request->pokemon_id, [
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Pokémon ajouté au deck !');
    }

    public function update(Request $request, Deck $deck, Pokemon $pokemon): RedirectResponse
    {
        $this->authorize('update', $deck);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $deck->pokemons()->updateExistingPivot($pokemon->id, [
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Quantité mise à jour !');
    }

    public function destroy(Deck $deck, Pokemon $pokemon): RedirectResponse
    {
        $this->authorize('update', $deck);
        $deck->pokemons()->detach($pokemon->id);

        return back()->with('success', 'Pokémon retiré du deck.');
    }
}
