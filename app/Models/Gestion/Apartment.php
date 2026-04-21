<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'copropriete_id',
        'user_id',
        'etage',
        'surface',
        'nombre_pieces',
        'type',
        'statut',
        'balcon',
        'parking',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'copropriete_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
