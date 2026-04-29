<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contractor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'specialty_id',
        'note',
        'est_actif',
        'nom_entreprise',
        'notes',
        'user_id',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
