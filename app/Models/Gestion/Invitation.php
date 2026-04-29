<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Gestion\Building;


class Invitation extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'role',
        'used_at'
    ];
}
