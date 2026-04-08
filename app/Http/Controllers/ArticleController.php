<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\Topic;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterArticleMail;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('topic') 
                                ->orderBy('date_publication', 'desc')
                                ->get();
        $topics = Topic::all();

        return Inertia::render('Actualites', [
            'articles'=>$articles,
            'topics'=>$topics 
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
        $article = Article::with('topic')->findOrFail($id);
        $articles = Article::with('topic') 
                                ->orderBy('date_publication', 'desc')
                                ->get();
        $topics = Topic::all();

        return Inertia::render('Article',['article'=>$article, 'articles' => $articles, 'topics'=>$topics
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
    public function sendNewsletter(Article $article)
{
    $subscribers = Subscriber::where('is_verified', true)->get();

    foreach($subscribers as $subscriber){
        Mail::to($subscriber->email)->send(new NewsletterArticleMail($subscriber, $article));
    }
}
}
