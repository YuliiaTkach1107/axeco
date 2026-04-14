<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_verified',
        'verification_token',
        'unsubscribed_at',
        'unsubscribe_token',
    ];
}

