<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'content',
        'image_url',
        'accentColor',
        'bgColor',
        'anchor',
        'link'
    ];

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
