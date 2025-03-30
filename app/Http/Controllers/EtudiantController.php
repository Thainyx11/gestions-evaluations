<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index()
    {
        $etudiants = Etudiant::all();

        return Inertia::render('Etudiants/Index', [
            'etudiants' => $etudiants
        ]);
    }

    /**
     * Affiche le formulaire de création d'un étudiant
     */
    public function create()
    {
        return Inertia::render('Etudiants/Create');
    }

    /**
     * Enregistre un nouvel étudiant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'numero_etudiant' => 'required|string|unique:etudiants,numero_etudiant',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant créé avec succès.');
    }

    /**
     * Affiche les détails d'un étudiant
     */
    public function show(Etudiant $etudiant)
    {
        $etudiant->load('evaluations.cours');

        return Inertia::render('Etudiants/Show', [
            'etudiant' => $etudiant
        ]);
    }

    /**
     * Affiche le formulaire d'édition d'un étudiant
     */
    public function edit(Etudiant $etudiant)
    {
        return Inertia::render('Etudiants/Edit', [
            'etudiant' => $etudiant
        ]);
    }

    /**
     * Met à jour un étudiant
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,'.$etudiant->id,
            'numero_etudiant' => 'required|string|unique:etudiants,numero_etudiant,'.$etudiant->id,
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Supprime un étudiant
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }
}
