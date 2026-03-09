<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonSeeder extends Seeder
{
    public function run()
    {
        $types = DB::table('types')->pluck('id', 'name')->toArray();

        $file = database_path('data/pokemon.csv');

        if (!file_exists($file)) {
            $this->command->error("Le fichier CSV n'existe pas !");
            return;
        }
        $type2 = null;

        if (!empty($row[37])) {
            $typeModel = Type::where('name', strtolower($row[37]))->first();
            $type2 = $typeModel ? $typeModel->id : null;
        }



        $data = array_map('str_getcsv', file($file));
        array_shift($data); // Première ligne = noms de colonnes

        foreach ($data as $row) {
            $imageName = strtolower(str_replace(' ', '-', $row[31]));
            // Prend le nom du Pokémon depuis le CSV
            $imageName = $row[30] ?? 'default';

            // Convertit en minuscules
            $imageName = strtolower($imageName);

            // Enlève tout ce qui n'est pas lettre ou chiffre
            $imageName = preg_replace('/[^a-z0-9]/', '', $imageName);

            $imagePath = public_path("images/{$imageName}.png");

            $imageUrl = file_exists($imagePath)
                ? "/images/{$imageName}.png"
                : "/images/default.png";
            Pokemon::upsert(
                    [   'pokedex_number' => $row[32],
                        'name' => $row[30] ?? 'Unknown',
                        'type_id' => isset($row[36])?  Type::where("name",ucfirst($row[36]) )->first()->id:null,
                        'type2_id' => !empty(trim($row[37] ?? ''))
                            ? Type::whereRaw('LOWER(name) = ?', [strtolower(trim($row[37]))])->value('id')
                            : null,
                        'is_legendary' => $row[40] ?? 0,
                        'image_url' => $imageUrl,
                        'hp' => $row[28],
                        'defense' => $row[25],
                        'attack' => $row[19],
                        'speed' => $row[35],
                        'sp_attack' => $row[33],
                        'sp_defense' => $row[34],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], 'pokedex_number'
                );
            }
            $this->command->info("Pokémons importés depuis le CSV !");

    }
}
