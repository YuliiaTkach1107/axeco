<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'topic_id',
        'date_publication',
        'newsletter_sent_at',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'date_publication' => 'date',
            'newsletter_sent_at' => 'datetime',
        ];
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
