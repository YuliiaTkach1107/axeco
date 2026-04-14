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
        'content',
    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

}