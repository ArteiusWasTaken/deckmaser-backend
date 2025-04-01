<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pkmn_tcgplayer_prices', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('card_id', 20);
            $table->foreign('card_id')->references('id')->on('pkmn_cards')->cascadeOnDelete();
            $table->text('url');
            $table->jsonb('prices');
            $table->timestamps();
        });

        Schema::table('pkmn_tcgplayer_prices', function (Blueprint $table) {
            $table->index(['card_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkmn_tcgplayer_prices');
    }
};

