<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticlePublishedMail;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function afterCreate(): void
    {
        $article = $this->record;

        $subscribers = Subscriber::where('is_verified', true)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewArticlePublishedMail($article, $subscriber));
        }
    }
}

