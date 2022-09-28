<?php

namespace App\Services;

use App\Models\Coin;
use App\Repositories\CoinApiRepository;
use Illuminate\Support\Facades\Http;

class ListSingleCoinService
{
    private CoinApiRepository $coinApiRepository;

    public function __construct(CoinApiRepository $coinApiRepository)
    {

        $this->coinApiRepository = $coinApiRepository;
    }
    public function execute(): Coin
    {
        return $this->coinApiRepository->getSingle();
    }

}
