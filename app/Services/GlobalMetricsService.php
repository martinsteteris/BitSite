<?php

namespace App\Services;

use App\Models\Coin;
use App\Models\GlobalMetrics;
use App\Repositories\CoinApiRepository;
use App\Repositories\GlobalMetricsApiRepository;
use Illuminate\Support\Facades\Http;

class GlobalMetricsService
{


    private GlobalMetricsApiRepository $globalMetricsApiRepository;

    public function __construct(GlobalMetricsApiRepository $globalMetricsApiRepository)
    {

        $this->globalMetricsApiRepository = $globalMetricsApiRepository;
    }
    public function execute(): GlobalMetrics
    {
        return $this->globalMetricsApiRepository->getAll();
    }

}
