<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Topic;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
{
    // Получаем, например, последние 6 статей
        $articles = Article::with('topic') 
                                ->orderBy('date_publication', 'desc')
                                ->take(6)
                                ->get();
        $topics = Topic::all();

    return Inertia::render('PageAccueil', [
        'articles' => $articles,
        'topics'   => $topics
    ]);
}
}
