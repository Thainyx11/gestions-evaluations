<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Cours;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        $totalEtudiants = Etudiant::count();
        $totalCours = Cours::count();
        $totalEvaluations = Evaluation::count();

        $dernieresEvaluations = Evaluation::with(['etudiant', 'cours'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'totalEtudiants' => $totalEtudiants,
            'totalCours' => $totalCours,
            'totalEvaluations' => $totalEvaluations,
            'dernieresEvaluations' => $dernieresEvaluations
        ]);
    }
}
