<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'ville',
        'code_postal',
        'nombre_logements',
        'nombre_etages',
        'annee_construction',
        'nom_syndic',
        'email_contact',
        'telephone_contact',
        'ascenseur',
        'parking',
        'notes',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'appartement_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function announsements()
    {
        return $this->hasMany(Announcement::class, 'announcement_id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

}
