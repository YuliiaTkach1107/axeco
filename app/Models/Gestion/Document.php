<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{
    use HasFactory;

    protected $fillable=[
        'titre',
        'description' , 
        'fichier_lien',
        'type',
        'building_id',
        'user_id',
        'est_public',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected static function booted()
    {
        static::creating(function ($doc) {

        if ($doc->type === 'public') {
            $doc->building_id = null;
            $doc->user_id = null;
        }

        if ($doc->type === 'building') {
            $doc->user_id = null;
        }
        $doc->est_public = ($doc->type === 'public');
    });
    }
}
