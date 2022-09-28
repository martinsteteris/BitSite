<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Services\GlobalMetricsService;
use App\Services\ListCoinsService;
use App\Services\ListSingleCoinService;

class CoinsApiController extends Controller
{
    public function index(ListCoinsService $coins, GlobalMetricsService $globalMetrics)
    {
        return view('coin-listings.index', [
            'coins' => Asset::paginate(10),
            'globalMetrics' => $globalMetrics->execute()
            ]
        );
    }
}

