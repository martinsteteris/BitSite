<?php

namespace App\Repositories;

use App\Models\Coin;
use Illuminate\Support\Facades\Http;

class CoinApiRepository
{
    public function getAll(): array
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => getenv('API_KEY_CMC')
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?limit=20');
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];

        $coins = [];
        foreach ($data as $coin) {
            $coins[] = [
                'crypto_id' => $coin['id'],
                'cmc_rank' => $coin['cmc_rank'],
                'symbol' => $coin['symbol'],
                'name' => $coin['name'],
                'price' => $coin['quote']['USD']['price'],
                'percent_change_1h' => $coin['quote']['USD']['percent_change_1h'],
                'percent_change_24h' => $coin['quote']['USD']['percent_change_24h'],
                'percent_change_7d' => $coin['quote']['USD']['percent_change_7d'],
                'market_cap' => $coin['quote']['USD']['market_cap'],
            ];
        }

        return $coins;
    }

    public function getSingle(): Coin
    {
        $request = request()->query('symbol');
//        dd($request);
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => getenv('API_KEY_CMC')
        ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest?symbol=' . $request);
//        $cache = \Cache::remember()
        $data = json_decode($response->getBody(), true);
        $coin = $data['data']["$request"][0];
//        dd($request);

            return new Coin(
                $coin['id'],
                $coin['cmc_rank'],
                $coin['symbol'],
                $coin['name'],
                $coin['quote']['USD']['price'],
                $coin['quote']['USD']['percent_change_1h'],
                $coin['quote']['USD']['percent_change_24h'],
                $coin['quote']['USD']['percent_change_7d'],
                $coin['quote']['USD']['market_cap'],
            );

    }


}
