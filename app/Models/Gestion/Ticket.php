<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        'note_contractor',
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
    protected static function booted()
    {
        static::updating(function ($ticket) {
            $user = Auth::user();
            if ($user?->role === 'contractor') {
                $allowed = ['statut', 'note_contractor'];
                foreach ($ticket->getDirty() as $field => $value) {
                    if (!in_array($field, $allowed)) {
                        $ticket->{$field} = $ticket->getOriginal($field);
                    }
                }
            }
            if ($user?->role === 'proprietaire') {
                $allowed = ['title','description'];
                foreach ($ticket->getDirty() as $field => $value) {
                    if (!in_array($field, $allowed)) {
                        $ticket->{$field} = $ticket->getOriginal($field);
                    }
                }
            }
            if ($ticket->isDirty('contractor_id')&& $ticket->contractor_id&& !$ticket->assigne_le) {
                $ticket->assigne_le = now();
        }
            if ($ticket->isDirty('statut')&& in_array($ticket->statut, ['résolu', 'fermé'])&& !$ticket->resolu_le) {
                $ticket->resolu_le = now();
        }
        });
        static::creating(function ($ticket) {

            $user = Auth::user();

            if ($user?->role === 'resident' && $user->resident) {
                $ticket->resident_id = $user->resident->id;
                $ticket->apartment_id = $user->resident->appartement_id;
                $ticket->building_id = $user->resident->copropriete_id;
                $ticket->statut = 'ouvert';
            }

});
    }
}
