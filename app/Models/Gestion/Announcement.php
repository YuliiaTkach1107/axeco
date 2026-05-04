<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    protected function casts(): array
    {
        return [
            'publie_le' => 'datetime',
            'expire_le' => 'datetime',
            'est_actif' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Announcement $announcement): void {
            if (! $announcement->expire_le) {
                return;
            }

            $announcement->est_actif = Carbon::parse($announcement->expire_le)->isFuture();
        });
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
