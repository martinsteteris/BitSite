<?php

namespace App\Models;

class GlobalMetrics
{
    private float $btcDominance;
    private float $ethDominance;
    private int $totalCryptocurrencies;
    private int $activeCryptocurrencies;
    private float $totalMarketCap;
    private float $totalVolume24H;

    public function __construct(
        float $btcDominance,
        float $ethDominance,
        int $totalCryptocurrencies,
        int $activeCryptocurrencies,
        float $totalMarketCap,
        float $totalVolume24H
    )
    {

        $this->btcDominance = $btcDominance;
        $this->ethDominance = $ethDominance;
        $this->totalCryptocurrencies = $totalCryptocurrencies;
        $this->activeCryptocurrencies = $activeCryptocurrencies;
        $this->totalMarketCap = $totalMarketCap;
        $this->totalVolume24H = $totalVolume24H;
    }

    public function getActiveCryptocurrencies(): int
    {
        return $this->activeCryptocurrencies;
    }

    public function getBtcDominance(): float
    {
        return $this->btcDominance;
    }

    public function getEthDominance(): float
    {
        return $this->ethDominance;
    }

    public function getTotalCryptocurrencies(): int
    {
        return $this->totalCryptocurrencies;
    }

    public function getTotalMarketCap(): float
    {
        return $this->totalMarketCap;
    }

    public function getTotalVolume24H(): float
    {
        return $this->totalVolume24H;
    }
}
