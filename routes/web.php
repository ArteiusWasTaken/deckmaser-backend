<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonTcgController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pokemon')->group(function () {
    Route::get('/import/sets', [PokemonTcgController::class, 'importSets']);
    Route::get('/import/cards', [PokemonTcgController::class, 'importCards']);
    Route::get('/import/types', [PokemonTcgController::class, 'importTypes']);
    Route::get('/import/subtypes', [PokemonTcgController::class, 'importSubtypes']);
    Route::get('/import/supertypes', [PokemonTcgController::class, 'importSupertypes']);
    Route::get('/import/rarities', [PokemonTcgController::class, 'importRarities']);
});
