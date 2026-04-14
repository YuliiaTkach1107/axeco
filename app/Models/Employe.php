<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'departement_id',
        'position_id',
        'avatar',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
