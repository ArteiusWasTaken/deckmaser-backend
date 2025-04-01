<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class PokemonTcgService
{
    private string $apiUrl = 'https://api.pokemontcg.io/v2/';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.pokemontcg.key');
    }

    /**
     * @throws ConnectionException
     */
    private function fetch(string $endpoint, array $params = [])
    {
        $response = Http::withHeaders([
            'X-Api-Key' => $this->apiKey,
        ])->get($this->apiUrl . $endpoint, $params);

        return $response->successful() ? $response->json() : null;
    }

    /**
     * @throws ConnectionException
     */
    public function importSets()
    {
        return $this->fetch('sets');
    }

    /**
     * @throws ConnectionException
     */
    public function importCards($set)
    {
        return $this->fetch('cards', ['q' => 'set.id:'.$set]);
    }

    /**
     * @throws ConnectionException
     */
    public function importTypes()
    {
        return $this->fetch('types');
    }

    /**
     * @throws ConnectionException
     */
    public function importsubTypes()
    {
        return $this->fetch('subtypes');
    }

    /**
     * @throws ConnectionException
     */
    public function importSupertypes()
    {
        return $this->fetch('supertypes');
    }

    /**
     * @throws ConnectionException
     */
    public function importRarities()
    {
        return $this->fetch('rarities');
    }

}
