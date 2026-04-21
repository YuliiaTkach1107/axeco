<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Gestion\Document;
use App\Models\Gestion\Building;
use App\Models\Gestion\Apartment;
use App\Models\Gestion\Resident;
use App\Models\Gestion\Contractor;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'building_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
    public function building(){
        return $this->belongsTo(Building::class);
    }
    public function canAccessFilament(): bool
    {
        return in_array($this->role, [
            'admin',
            'proprietaire',
        ]);
    }
    public function apartments(){
        return $this->hasMany(Apartment::class);
    }
    public function resident()
    {
        return $this->hasOne(Resident::class);
    }
    public function contractor()
    {
        return $this->hasOne(Contractor::class,'user_id');
    }
}
