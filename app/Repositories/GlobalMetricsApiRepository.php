<?php

namespace App\Repositories;

use App\Models\GlobalMetrics;
use Illuminate\Support\Facades\Http;

class GlobalMetricsApiRepository
{
    public function getAll(): GlobalMetrics {
    $response = Http::withHeaders([
        'X-CMC_PRO_API_KEY' => getenv('API_KEY_CMC')
    ])->get('https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest');
    $data = json_decode($response->getBody(), true);
    $data = $data['data'];
//    dd($data);
    return new GlobalMetrics(
        $data['btc_dominance'],
        $data['eth_dominance'],
        $data['total_cryptocurrencies'],
        $data['active_cryptocurrencies'],
        $data['quote']['USD']['total_market_cap'],
        $data['quote']['USD']['total_volume_24h'],
    );
}

}
