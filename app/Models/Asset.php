<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Asset extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'crypto_id','cmc_rank','symbol','name','price','percent_change_1h','percent_change_24h','percent_change_7d','market_cap'
    ];


}
