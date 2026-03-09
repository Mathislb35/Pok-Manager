<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deck extends Model
{
    protected $fillable = ['name', 'description', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'deck_pokemon', 'deck_id', 'pokemon_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function totalCards(): int
    {
        return $this->pokemons->sum('pivot.quantity');
    }
}
