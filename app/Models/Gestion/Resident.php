<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Carbon;

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
        'user_id'
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted()

    {

        static::saving(function ($resident) {
            $start = $resident->date_entre;
            $end = $resident->date_sortie;
            if (!$start) {
                $resident->est_actif = false;
                return;
            }
            if ($end && Carbon::parse($end)->lt(now())) {
                $resident->est_actif = false;
                return;
            }
            $resident->est_actif = true;
        });
    }
}
