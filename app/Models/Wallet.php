<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'user_id'
        ];

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
