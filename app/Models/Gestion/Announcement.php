<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'building_id',
        'publie_le',
        'expire_le',
        'cree_par',
        'est_actif',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
