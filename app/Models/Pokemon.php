<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function type2()
    {
        return $this->belongsTo(Type::class, 'type2_id');
    }

    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'deck_pokemon')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}

