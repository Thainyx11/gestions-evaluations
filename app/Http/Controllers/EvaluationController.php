<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Etudiant;
use App\Models\Cours;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationController extends Controller
{
    /**
     * Affiche la liste des évaluations
     */
    public function index()
    {
        $evaluations = Evaluation::with(['etudiant', 'cours'])->get();

        return Inertia::render('Evaluations/Index', [
            'evaluations' => $evaluations
        ]);
    }

    /**
     * Affiche le formulaire de création d'une évaluation
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        $cours = Cours::all();

        return Inertia::render('Evaluations/Create', [
            'etudiants' => $etudiants,
            'cours' => $cours
        ]);
    }

    /**
     * Enregistre une nouvelle évaluation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'cours_id' => 'required|exists:cours,id',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);

        Evaluation::create($validated);

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation créée avec succès.');
    }

    /**
     * Affiche les détails d'une évaluation
     */
    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['etudiant', 'cours']);

        return Inertia::render('Evaluations/Show', [
            'evaluation' => $evaluation
        ]);
    }

    /**
     * Affiche le formulaire d'édition d'une évaluation
     */
    public function edit(Evaluation $evaluation)
    {
        $etudiants = Etudiant::all();
        $cours = Cours::all();

        return Inertia::render('Evaluations/Edit', [
            'evaluation' => $evaluation,
            'etudiants' => $etudiants,
            'cours' => $cours
        ]);
    }

    /**
     * Met à jour une évaluation
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'cours_id' => 'required|exists:cours,id',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);

        $evaluation->update($validated);

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation mise à jour avec succès.');
    }

    /**
     * Supprime une évaluation
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation supprimée avec succès.');
    }

    /**
     * Génère un rapport des résultats
     */
    public function genererRapport()
    {
        $etudiants = Etudiant::with(['evaluations.cours'])->get();
        $resultats = [];

        foreach ($etudiants as $etudiant) {
            $totalCoef = 0;
            $totalPoints = 0;
            $reussite = true;

            foreach ($etudiant->evaluations as $evaluation) {
                $coef = $evaluation->cours->coefficient;
                $totalCoef += $coef;
                $totalPoints += $evaluation->note * $coef;

                if ($evaluation->note < $evaluation->cours->seuil_reussite) {
                    $reussite = false;
                }
            }

            $moyenne = $totalCoef > 0 ? $totalPoints / $totalCoef : 0;

            $resultats[] = [
                'etudiant' => $etudiant,
                'moyenne' => round($moyenne, 2),
                'reussite' => $reussite,
                'status' => $moyenne >= 10 && $reussite ? 'Admis' : ($moyenne >= 8 ? 'Ajourné' : 'Refusé')
            ];
        }

        return Inertia::render('Evaluations/Rapport', [
            'resultats' => $resultats
        ]);
    }
}
