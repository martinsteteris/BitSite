<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'user_id',
        'price',
        'status'
    ];

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
