<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pkmn_card_sets', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('name', 255);
            $table->string('series', 255);
            $table->integer('printed_total');
            $table->integer('total');
            $table->string('ptcgo_code', 10)->nullable();
            $table->date('release_date');
            $table->jsonb('legalities');
            $table->jsonb('images');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkmn_card_sets');
    }
};

