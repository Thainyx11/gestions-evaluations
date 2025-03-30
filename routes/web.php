<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EvaluationController;


Route::redirect('/', '/dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard (page d'accueil)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Routes pour les étudiants
    Route::resource('etudiants', EtudiantController::class);

    // Routes pour les cours
    Route::resource('cours', CoursController::class);

    // Routes pour les évaluations
    Route::resource('evaluations', EvaluationController::class);

    // Route pour la génération de rapport
    Route::get('/rapport', [EvaluationController::class, 'genererRapport'])->name('rapport');
});
