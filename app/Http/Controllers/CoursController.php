<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursController extends Controller
{
    /**
     * Affiche la liste des cours
     */
    public function index()
    {
        $cours = Cours::all();

        return Inertia::render('Cours/Index', [
            'cours' => $cours
        ]);
    }

    /**
     * Affiche le formulaire de création d'un cours
     */
    public function create()
    {
        return Inertia::render('Cours/Create');
    }

    /**
     * Enregistre un nouveau cours
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coefficient' => 'required|integer|min:1',
            'seuil_reussite' => 'required|integer|min:0|max:20',
        ]);

        Cours::create($validated);

        return redirect()->route('cours.index')
            ->with('success', 'Cours créé avec succès.');
    }

    /**
     * Affiche les détails d'un cours
     */
    public function show(Cours $cours)
    {
        $cours->load('evaluations.etudiant');

        return Inertia::render('Cours/Show', [
            'cours' => $cours
        ]);
    }

    /**
     * Affiche le formulaire d'édition d'un cours
     */
    public function edit(Cours $cours)
    {
        return Inertia::render('Cours/Edit', [
            'cours' => $cours
        ]);
    }

    /**
     * Met à jour un cours
     */
    public function update(Request $request, Cours $cours)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coefficient' => 'required|integer|min:1',
            'seuil_reussite' => 'required|integer|min:0|max:20',
        ]);

        $cours->update($validated);

        return redirect()->route('cours.index')
            ->with('success', 'Cours mis à jour avec succès.');
    }

    /**
     * Supprime un cours
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();

        return redirect()->route('cours.index')
            ->with('success', 'Cours supprimé avec succès.');
    }
}
