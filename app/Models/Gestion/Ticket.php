<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'statut',
        'priorite',
        'resident_id',
        'building_id',
        'apartment_id',
        'contractor_id',
        'note_admin',
        'assigne_le',
        'resolu_le',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }
}
