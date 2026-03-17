<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('PageAccueil');
})->name('PageAccueil');

Route::get('/services', function () {
    return Inertia::render('Services');
})->name('Services');

// Route::get('/actualites', function () {
//     return Inertia::render('Actualites');
// })->name('Actualites');

Route::get('/actualites', [ArticleController::class, 'index'])->name('Actualites');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('Article');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('Contact');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
    ->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

require __DIR__.'/settings.php';
