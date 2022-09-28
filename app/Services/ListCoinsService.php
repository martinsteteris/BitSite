<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Coin;
use App\Repositories\CoinApiRepository;
use Illuminate\Support\Facades\Http;

class ListCoinsService
{
    private CoinApiRepository $coinApiRepository;

    public function __construct(CoinApiRepository $coinApiRepository)
    {
        $this->coinApiRepository = $coinApiRepository;
    }

    public function execute()
    {
        foreach ($this->coinApiRepository->getAll() as $row) {
            Asset::create($row);
        }

    }


}
