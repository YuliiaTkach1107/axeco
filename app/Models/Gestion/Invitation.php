<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'role',
        'used_at',
    ];
}
