<?php

namespace App\Console\Commands;

use App\Services\ListCoinsService;
use Illuminate\Console\Command;

class UpdateAssets extends Command
{
    private ListCoinsService $allCryptoApiService;

    public function __construct(ListCoinsService $allCryptoApiService)
    {
        $this->allCryptoApiService = $allCryptoApiService;
        parent::__construct();
    }

    protected $signature = 'update';

    protected $description = 'Update DB assets from API';

    public function handle()
    {
        $this->allCryptoApiService->execute();
    }
}

