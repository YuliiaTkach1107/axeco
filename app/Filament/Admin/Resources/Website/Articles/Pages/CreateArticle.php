<?php

namespace App\Filament\Admin\Resources\Website\Articles\Pages;

use App\Filament\Admin\Resources\Website\Articles\ArticleResource;
use App\Mail\NewArticlePublishedMail;
use App\Models\Subscriber;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

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
