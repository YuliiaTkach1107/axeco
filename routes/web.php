<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FaqController;


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('PageAccueil');

Route::get('/faq', [FaqController::class, 'index'])->name('FAQ');


Route::get('/services', [ServiceController::class, 'index'])->name('Services');


Route::get('/actualites', [ArticleController::class, 'index'])->name('Actualites');
Route::get('actualites/article/{id}', [ArticleController::class, 'show'])->name('Article');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('Contact');

Route::get('/notre-equipe', [EmployeController::class, 'index'])->name('Notre_equipe');

Route::get('/a-propos', function () {
    return Inertia::render('A_propos');
})->name('A_propos');


Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
    ->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');


Route::get('/contact', [ContactController::class, 'index'])->name('Contact');;
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/resume-send', [ResumeController::class, 'send'])->name('resume.send');
require __DIR__.'/settings.php';
