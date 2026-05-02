<?php
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('PageAccueil');

Route::get('/faq', [FaqController::class, 'index'])->name('FAQ');

Route::get('/services', [ServiceController::class, 'index'])->name('Services');

Route::get('/actualites', [ArticleController::class, 'index'])->name('Actualites');
Route::get('actualites/article/{id}', [ArticleController::class, 'show'])->name('Article');

// Route::get('/contact', [ContactController::class, 'index'])->name('Contact');
// Route::get('/contact', function () {
//     return Inertia::render('Contact');
// })->name('Contact');

Route::get('/notre-equipe', [EmployeController::class, 'index'])->name('Notre_equipe');

Route::get('/a-propos', function () {
    return Inertia::render('A_propos');
})->name('A_propos');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->middleware('throttle:newsletter-subscribe')
    ->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
    ->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

Route::get('/contact', [ContactController::class, 'index'])->name('Contact');
Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:contact-form')->name('contact.send');
Route::post('/resume-send', [ResumeController::class, 'send'])->middleware('throttle:resume-send')->name('resume.send');
Route::get('/enter-code', function () {
    if (Auth::check()) {
        return Inertia::location('/admin');
    }
    return Inertia::render('auth/EnterCode');
})->name('EnterCode');

Route::middleware('guest')->group(function () {
// Route::get('/enter-code', function () {
//     return Inertia::render('auth/EnterCode');
// })->name('EnterCode');

Route::post('/check-invitation', [InvitationController::class, 'check']);
Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');
});

Route::get('/privacy-policy', function () {
    return Inertia::render('Legal/Privacy');
})->name('PrivacyPolicy');
Route::get('/mentions-legales', function () {
    return Inertia::render('Legal/Mentions');
})->name('Mentions');
Route::get('/cookie-policy', function () {
    return Inertia::render('Legal/CookiePolicy');
})->name('CookiePolicy');

require __DIR__.'/settings.php';
