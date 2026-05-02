<?php

namespace App\Console\Commands;

use App\Mail\NewArticlePublishedMail;
use App\Models\Article;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendScheduledArticleNewsletters extends Command
{
    protected $signature = 'articles:send-newsletters';

    protected $description = 'Send newsletters for articles whose publication date has arrived.';

    public function handle(): int
    {
        $articles = Article::query()
            ->whereDate('date_publication', '<=', now()->toDateString())
            ->whereNull('newsletter_sent_at')
            ->get();

        if ($articles->isEmpty()) {
            $this->info('No scheduled article newsletters to send.');

            return self::SUCCESS;
        }

        $subscribers = Subscriber::query()
            ->where('is_verified', true)
            ->get();

        foreach ($articles as $article) {
            $article->forceFill([
                'newsletter_sent_at' => now(),
            ])->save();
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewArticlePublishedMail($article, $subscriber));
            }
        }

        $this->info("Processed {$articles->count()} scheduled article(s).");

        return self::SUCCESS;
    }
}
