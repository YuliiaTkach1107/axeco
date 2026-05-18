<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\FAQ;
use App\Models\Service;
use App\Models\Topic;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with('topic')
            ->whereDate('date_publication', '<=', now()->toDateString())
            ->orderBy('date_publication', 'desc')
            ->take(6)
            ->get()
            ->map(function ($article) {
                $article->image_url = $article->image_url
                    ? Storage::url($article->image_url)
                    : null;

                return $article;
            });
        $topics = Topic::all();
        $services = Service::all()
            ->map(function ($service) {
                $service->image_url = $service->image_url
                    ? Storage::url($service->image_url)
                    : null;

                return $service;
            });
        $faqs = FAQ::latest()->take(4)->get();

        return Inertia::render('PageAccueil', [
            'articles' => $articles,
            'topics' => $topics,
            'services' => $services,
            'faqs' => $faqs,
        ]);
    }
}
