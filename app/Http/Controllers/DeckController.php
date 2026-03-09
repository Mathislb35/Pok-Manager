<?php
namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeckController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function index(): View
    {
        $decks = auth()->user()->decks()->with('pokemons')->get();
        return view('decks.index', compact('decks'));
    }

    public function create(): View
    {
        return view('decks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $deck = auth()->user()->decks()->create($validated);

        // Si un pokemon_id est fourni, l'ajouter au deck
        if ($request->has('pokemon_id')) {
            $deck->pokemons()->attach($request->pokemon_id, [
                'quantity' => $request->input('quantity', 1),
            ]);

            return redirect()->route('pokemons.show', $request->pokemon_id)
                ->with('success', 'Deck créé et Pokémon ajouté !');
        }

        return redirect()->route('decks.show', $deck)
            ->with('success', 'Deck créé avec succès !');
    }

    public function show(Deck $deck): View
    {
        $this->authorize('view', $deck);
        $deck->load('pokemons.type', 'pokemons.type2');
        return view('decks.show', compact('deck'));
    }

    public function edit(Deck $deck): View
    {
        $this->authorize('update', $deck);
        return view('decks.edit', compact('deck'));
    }

    public function update(Request $request, Deck $deck): RedirectResponse
    {
        $this->authorize('update', $deck);

        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $deck->update($validated);

        return redirect()->route('decks.show', $deck)
            ->with('success', 'Deck mis à jour !');
    }

    public function destroy(Deck $deck): RedirectResponse
    {
        $this->authorize('delete', $deck);
        $deck->delete();

        return redirect()->route('decks.index')
            ->with('success', 'Deck supprimé.');
    }
}
