<?php

namespace App\Http\Controllers;

use App\Models\Tp;
use Illuminate\Http\Request;

class TpController extends Controller
{
    // Affiche la liste des travaux pratiques
    public function index()
    {
        $tps = Tp::all();
        return view('tps.index', compact('tps'));
    }

    // Affiche le formulaire de création d'un travail pratique
    public function create()
    {
        return view('tps.create');
    }

    // Enregistre un nouveau travail pratique
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'fichier' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Exemple de validation pour un fichier
        ]);

        // Enregistrement du fichier dans le stockage (par exemple, dans le dossier storage/app/public)
        $fichier = $request->file('fichier');
        $fichierName = time() . '_' . $fichier->getClientOriginalName();
        $fichier->storeAs('public', $fichierName);

        // Création du travail pratique avec le chemin du fichier dans la base de données
        Tp::create([
            'course_id' => $request->course_id,
            'name' => $request->name,
            'fichier' => $fichierName, // Enregistrement du nom du fichier dans la base de données
        ]);

        return redirect()->route('tps.index')->with('success', 'Travail pratique créé avec succès.');
    }

    // Affiche les détails d'un travail pratique spécifique
    public function show($id)
    {
        $tp = Tp::findOrFail($id);
        return view('tps.show', compact('tp'));
    }

    // Affiche le formulaire d'édition d'un travail pratique spécifique
    public function edit($id)
    {
        $tp = Tp::findOrFail($id);
        return view('tps.edit', compact('tp'));
    }

    // Met à jour un travail pratique spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'fichier' => 'nullable|file|mimes:jpeg,png,pdf|max:2048', // Exemple de validation pour un fichier
        ]);

        $tp = Tp::findOrFail($id);

        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier s'il existe
            if ($tp->fichier && file_exists(storage_path("app/public/{$tp->fichier}"))) {
                unlink(storage_path("app/public/{$tp->fichier}"));
            }

            // Enregistrement du nouveau fichier dans le stockage
            $fichier = $request->file('fichier');
            $fichierName = time() . '_' . $fichier->getClientOriginalName();
            $fichier->storeAs('public', $fichierName);

            // Mettre à jour le nom du fichier dans la base de données
            $tp->fichier = $fichierName;
        }

        $tp->course_id = $request->course_id;
        $tp->name = $request->name;
        $tp->save();

        return redirect()->route('tps.index')->with('success', 'Travail pratique mis à jour avec succès.');
    }

    // Supprime un travail pratique spécifique
    public function destroy($id)
    {
        $tp = Tp::findOrFail($id);

        // Supprimer le fichier associé s'il existe
        if ($tp->fichier && file_exists(storage_path("app/public/{$tp->fichier}"))) {
            unlink(storage_path("app/public/{$tp->fichier}"));
        }

        $tp->delete();

        return redirect()->route('tps.index')->with('success', 'Travail pratique supprimé avec succès.');
    }
}
