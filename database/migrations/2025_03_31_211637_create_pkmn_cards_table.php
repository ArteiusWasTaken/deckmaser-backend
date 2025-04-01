<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pkmn_cards', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('name', 255);
            $table->string('set_id', 20);
            $table->foreign('set_id')->references('id')->on('pkmn_card_sets')->cascadeOnDelete();
            $table->string('supertype', 50);
            $table->jsonb('subtypes');
            $table->integer('hp')->nullable();
            $table->jsonb('types');
            $table->string('evolves_from', 255)->nullable();
            $table->jsonb('abilities')->nullable();
            $table->jsonb('attacks')->nullable();
            $table->jsonb('weaknesses')->nullable();
            $table->jsonb('retreat_cost')->nullable();
            $table->integer('converted_retreat_cost')->nullable();
            $table->string('rarity', 50)->nullable();
            $table->string('artist', 255)->nullable();
            $table->text('flavor_text')->nullable();
            $table->jsonb('national_pokedex_numbers')->nullable();
            $table->jsonb('legalities');
            $table->jsonb('images');
            $table->timestamps();
        });

        Schema::table('pkmn_cards', function (Blueprint $table) {
            $table->index(['set_id']);
            $table->index(['supertype']);
            $table->index(['rarity']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkmn_cards');
    }
};
