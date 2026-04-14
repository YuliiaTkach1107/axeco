<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'copropriete_id',
        'appartement_id',
        'role',
        'date_entre',
        'date_sortie',
        'est_actif',
        'notes',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'copropriete_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'appartement_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
