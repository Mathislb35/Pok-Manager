<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable = ['name', 'color'];

    public function pokemons(): HasMany
    {
        return $this->hasMany(Pokemon::class, 'type_id');
    }

    public function pokemons2(): HasMany
    {
        return $this->hasMany(Pokemon::class, 'type2_id');
    }

    public function getDisplayNameAttribute(): string
    {
        $translations = [
            'Normal' => 'Normal',
            'Fire' => 'Feu',
            'Water' => 'Eau',
            'Electric' => 'Électrique',
            'Grass' => 'Plante',
            'Ice' => 'Glace',
            'Fighting' => 'Combat',
            'Poison' => 'Poison',
            'Ground' => 'Sol',
            'Flying' => 'Vol',
            'Psychic' => 'Psy',
            'Bug' => 'Insecte',
            'Rock' => 'Roche',
            'Ghost' => 'Spectre',
            'Dragon' => 'Dragon',
            'Dark' => 'Ténèbres',
            'Steel' => 'Acier',
            'Fairy' => 'Fée',
        ];

        return $translations[$this->name] ?? $this->name;
    }
}
