<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Models\Type;


class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $query = Pokemon::with(['type', 'type2']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('type')) {
            $query->where(function ($q) use ($request) {
                $q->where('type_id', $request->type)
                    ->orWhere('type2_id', $request->type);
            });
        }

        $pokemons = $query->orderBy('pokedex_number')->paginate(24)->withQueryString();
        $types = Type::orderBy('name')->get();

        return view('pokemons.index', compact('pokemons', 'types')); // ← Et ici aussi !
    }
    public function show(Pokemon $pokemon)
    {
        return view('pokemons.show', compact('pokemon'));
    }
}
