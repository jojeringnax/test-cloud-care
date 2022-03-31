<?php

namespace App\Http\Requests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Http\Responses\PunkAPIResponse;
use App\Models\Beer;
use Illuminate\Support\Facades\Log;

class PunkAPIClient
{
    /**
     * @var string
     */
    private string $endpoint = 'https://api.punkapi.com/v2/';

    public function __construct()
    {}

    /**
     * @param array|PunkAPIParams $params
     * @return Collection|Beer[]
     */
    public function list(array|PunkAPIParams $params = []): Collection
    {
        if (is_array($params)) {
            $params = new PunkAPIParams($params);
        }
        try {
            $response = Http::get("$this->endpoint/beers", $params->get());
            $body = $response->body();
            if (
                !$body ||
                !is_string($body)
            ) {
                 throw new \Exception('Something went wrong!');
            }
            $bodyArray = json_decode($body, true);
            return new Collection(array_map(fn(array $oneBeerArrayResponse) => PunkAPIResponse::asBeer($oneBeerArrayResponse), $bodyArray));
        } catch (\Exception $exception) {
            return new Collection();
        }
    }
}