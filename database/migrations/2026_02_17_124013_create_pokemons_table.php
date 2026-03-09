<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->integer('pokedex_number')->unique();
            $table->string('name')->unique();
            $table->foreignId('type_id')->nullable()->constrained('types')->cascadeOnDelete();
            $table->foreignId('type2_id')->nullable()->constrained('types')->nullOnDelete();
            $table->integer('hp')->default(0);
            $table->integer('attack')->default(0);
            $table->integer('defense')->default(0);
            $table->integer('sp_attack')->default(0);
            $table->integer('sp_defense')->default(0);
            $table->integer('speed')->default(0);
            $table->integer('total')->default(0);
            $table->integer('generation')->default(1);
            $table->boolean('is_legendary')->default(false);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pokemons'); }
};
