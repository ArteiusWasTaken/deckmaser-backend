<?php

namespace App\Http\Controllers;

use App\Models\PkmnCard;
use App\Models\PkmnCardmarketPrice;
use App\Models\PkmnCardSet;
use App\Models\PkmnRarities;
use App\Models\PkmnSubtypes;
use App\Models\PkmnSupertypes;
use App\Models\PkmnTcgplayerPrice;
use App\Models\PkmnTypes;
use Illuminate\Http\Client\ConnectionException;
use App\Services\PokemonTcgService;

class PokemonTcgController extends Controller
{
    private PokemonTcgService $service;

    public function __construct(PokemonTcgService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws ConnectionException
     */
    public function importSets()
    {
        $data = $this->service->importSets();
        foreach ($data['data'] as $set) {
            PkmnCardSet::updateOrCreate(
                ['id' => $set['id']],
                [
                    'name' => $set['name'],
                    'series' => $set['series'] ?? null,
                    'printed_total' => $set['printedTotal'] ?? null,
                    'total' => $set['total'] ?? null,
                    'ptcgo_code' => $set['ptcgoCode'] ?? null,
                    'release_date' => $set['releaseDate'] ?? null,
                    'legalities' => $set['legalities'] ?? [],
                    'images' => $set['images'] ?? [],
                ]
            );
        }
       return $data;
    }

    /**
     * @throws ConnectionException
     */
    public function importCards()
    {
        set_time_limit(0);
        $data = PkmnCardSet::orderByDesc('release_date')->pluck('id');

        foreach ($data as $set) {
            $cards = $this->service->importCards($set);

            foreach ($cards['data'] as $card) {
                PkmnCard::updateOrCreate(
                    ['id' => $card['id']],
                    [
                        'name' => $card['name'],
                        'set_id' => $card['set']['id'],
                        'supertype' => $card['supertype'] ?? null,
                        'subtypes' => $card['subtypes'] ?? [],
                        'hp' => $card['hp'] ?? null,
                        'types' => $card['types'] ?? [],
                        'evolves_from' => $card['evolvesFrom'] ?? null,
                        'abilities' => $card['abilities'] ?? [],
                        'attacks' => $card['attacks'] ?? [],
                        'weaknesses' => $card['weaknesses'] ?? [],
                        'retreat_cost' => $card['retreatCost'] ?? [],
                        'converted_retreat_cost' => $card['convertedRetreatCost'] ?? null,
                        'rarity' => $card['rarity'] ?? null,
                        'artist' => $card['artist'] ?? null,
                        'flavor_text' => $card['flavorText'] ?? null,
                        'national_pokedex_numbers' => $card['nationalPokedexNumbers'] ?? [],
                        'legalities' => $card['legalities'] ?? [],
                        'images' => $card['images'] ?? [],
                    ]
                );

                if (isset($card['cardmarket'])) {
                    PkmnCardmarketPrice::updateOrCreate(
                        ['card_id' => $card['id']],
                        [
                            'url' => $card['cardmarket']['url'],
                            'prices' => $card['cardmarket']['prices'] ?? [],
                        ]
                    );
                }

                if (isset($card['tcgplayer'])) {
                    PkmnTcgplayerPrice::updateOrCreate(
                        ['card_id' => $card['id']],
                        [
                            'url' => $card['tcgplayer']['url'],
                            'prices' => $card['tcgplayer']['prices'] ?? [],
                        ]
                    );
                }
            }
        }
        return response()->json($data);
    }

    /**
     * @throws ConnectionException
     */
    public function importTypes()
    {
        $data = $this->service->importTypes();
        foreach ($data['data'] as $type) {
            PkmnTypes::updateOrCreate(
                ['type_name' => $type],
            );
        }
        return $data;
    }

    /**
     * @throws ConnectionException
     */
    public function importSubtypes()
    {
        $data = $this->service->importsubTypes();
        foreach ($data['data'] as $subtype) {
            PkmnSubtypes::updateOrCreate(
                ['subtype_name' => $subtype],
            );
        }
        return $data;
    }

    /**
     * @throws ConnectionException
     */
    public function importSupertypes()
    {
        $data = $this->service->importSupertypes();
        foreach ($data['data'] as $supertype) {
            PkmnSupertypes::updateOrCreate(
                ['supertype_name' => $supertype],
            );
        }
        return $data;
    }

    /**
     * @throws ConnectionException
     */
    public function importRarities()
    {
        $data = $this->service->importRarities();
        foreach ($data['data'] as $rarity) {
            PkmnRarities::updateOrCreate(
                ['rarity_name' => $rarity],
            );
        }
        return $data;
    }

}
