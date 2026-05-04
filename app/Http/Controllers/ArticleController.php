<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('topic')
            ->whereDate('date_publication', '<=', now()->toDateString())
            ->orderBy('date_publication', 'desc')
            ->get();
        $topics = Topic::all();

        return Inertia::render('Actualites', [
            'articles' => $articles,
            'topics' => $topics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with('topic')
            ->where('id', $id)
            ->whereDate('date_publication', '<=', now()->toDateString())
            ->firstOrFail();
        $articles = Article::with('topic')
            ->whereDate('date_publication', '<=', now()->toDateString())
            ->orderBy('date_publication', 'desc')
            ->get();
        $topics = Topic::all();

        return Inertia::render('Article', ['article' => $article, 'articles' => $articles, 'topics' => $topics,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
