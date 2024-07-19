<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoAddress extends Model
{
    use HasFactory;

    protected $table = 'crypto_addresses';

    protected $fillable = [
        'user_id',
        'profession',
        'education',
        'biography'
    ];
}
