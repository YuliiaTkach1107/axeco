<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\FAQ;
use App\Models\Service;
use App\Models\Topic;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with('topic')
            ->orderBy('date_publication', 'desc')
            ->take(6)
            ->get();
        $topics = Topic::all();
        $services = Service::all();
        $faqs = FAQ::latest()->take(4)->get();

        return Inertia::render('PageAccueil', [
            'articles' => $articles,
            'topics' => $topics,
            'services' => $services,
            'faqs' => $faqs,
        ]);
    }
}
