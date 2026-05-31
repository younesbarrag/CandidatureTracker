<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistiquesController;

/*
|--------------------------------------------------------------------------
| Routes Web — CandidatureTracker
|--------------------------------------------------------------------------
|
| Toutes les routes sont :
|   - Protégées par le middleware 'auth' (Laravel Breeze)
|   - Nommées explicitement pour les utiliser dans les vues et redirections
|
| Commande de vérification : php artisan route:list
|
*/

// ─── Authentification (générée par Laravel Breeze) ──────────────────────────
require __DIR__.'/auth.php';

// ─── Redirection racine ─────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('dashboard'));

// ─── Routes protégées ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // ── Dashboard ─────────────────────────────────────────────────────────
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ── Statistiques ──────────────────────────────────────────────────────
    Route::get('/statistiques', [StatistiquesController::class, 'index'])
        ->name('statistiques');

    // ── Candidatures ──────────────────────────────────────────────────────
    //
    // Route::resource() génère automatiquement les 7 routes RESTful :
    //   GET    /candidatures            → index
    //   GET    /candidatures/create     → create
    //   POST   /candidatures            → store
    //   GET    /candidatures/{id}       → show
    //   GET    /candidatures/{id}/edit  → edit
    //   PUT    /candidatures/{id}       → update
    //   DELETE /candidatures/{id}       → destroy
    //
    Route::resource('candidatures', CandidatureController::class);

    // Routes non couvertes par resource() :
    Route::get('/archives', [CandidatureController::class, 'archives'])
        ->name('candidatures.archives');

    Route::post('/candidatures/{id}/restore', [CandidatureController::class, 'restore'])
        ->name('candidatures.restore');

    Route::get('/candidatures/{candidature}/download', [CandidatureController::class, 'download'])
        ->name('candidatures.download');

    // ── Entretiens (imbriqués sous candidatures pour store/create) ─────────
    //
    // Pour la création, on a besoin de la candidature parente :
    //   GET  /candidatures/{candidature}/entretiens/create  → create
    //   POST /candidatures/{candidature}/entretiens         → store
    //
    Route::get('/candidatures/{candidature}/entretiens/create', [EntretienController::class, 'create'])
        ->name('entretiens.create');

    Route::post('/candidatures/{candidature}/entretiens', [EntretienController::class, 'store'])
        ->name('entretiens.store');

    // Pour edit/update/delete, l'entretien seul suffit (URLs plus propres) :
    //   GET    /entretiens/{entretien}/edit  → edit
    //   PUT    /entretiens/{entretien}       → update
    //   DELETE /entretiens/{entretien}       → destroy
    //
    Route::get('/entretiens/{entretien}/edit', [EntretienController::class, 'edit'])
        ->name('entretiens.edit');

    Route::put('/entretiens/{entretien}', [EntretienController::class, 'update'])
        ->name('entretiens.update');

    Route::delete('/entretiens/{entretien}', [EntretienController::class, 'destroy'])
        ->name('entretiens.destroy');
});
