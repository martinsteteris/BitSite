<?php

namespace App\Models;

class Coin
{
    private int $rank;
    private string $symbol;
    private string $name;
    private float $priceCurrent;
    private float $priceChange1H;
    private float $priceChange24H;
    private float $priceChange7D;
    private float $marketCap;
    private int $id;

    public function __construct(
        int $id,
        int $rank,
        string $symbol,
        string $name,
        float $priceCurrent,
        float $priceChange1H,
        float $priceChange24H,
        float $priceChange7D,
        float $marketCap
    )
    {
        $this->rank = $rank;
        $this->symbol = $symbol;
        $this->name = $name;
        $this->priceCurrent = $priceCurrent;
        $this->priceChange1H = $priceChange1H;
        $this->priceChange24H = $priceChange24H;
        $this->priceChange7D = $priceChange7D;
        $this->marketCap = $marketCap;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }

    public function getPriceChange1H(): float
    {
        return $this->priceChange1H;
    }

    public function getPriceChange7D(): float
    {
        return $this->priceChange7D;
    }

    public function getPriceChange24H(): float
    {
        return $this->priceChange24H;
    }

    public function getPriceCurrent(): float
    {
        return $this->priceCurrent;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getId(): int
    {
        return $this->id;
    }
}



