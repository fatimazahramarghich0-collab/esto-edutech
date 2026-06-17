<?php

namespace App\Http\Controllers;

use App\Models\Td;
use Illuminate\Http\Request;

class TdController extends Controller
{
    // Affiche la liste des travaux dirigés
    public function index()
    {
        $tds = Td::all();
        return view('tds.index', compact('tds'));
    }

    // Affiche le formulaire de création d'un travail dirigé
    public function create()
    {
        return view('tds.create');
    }

    // Enregistre un nouveau travail dirigé
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Exemple de validation pour un fichier
        ]);

        // Enregistrement du fichier dans le stockage (par exemple, dans le dossier storage/app/public)
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public', $fileName);

        // Création du travail dirigé avec le chemin du fichier dans la base de données
        Td::create([
            'course_id' => $request->course_id,
            'name' => $request->name,
            'fichier' => $fileName, // Enregistrement du nom du fichier dans la base de données
        ]);

        return redirect()->route('tds.index')->with('success', 'Travail dirigé créé avec succès.');
    }

    // Affiche les détails d'un travail dirigé spécifique
    public function show(string $id)
    {
        $td = Td::findOrFail($id);
        return view('tds.show', compact('td'));
    }

    // Affiche le formulaire d'édition d'un travail dirigé spécifique
    public function edit(string $id)
    {
        $td = Td::findOrFail($id);
        return view('tds.edit', compact('td'));
    }

    // Met à jour un travail dirigé spécifique
    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,pdf|max:2048', // Exemple de validation pour un fichier
        ]);

        $td = Td::findOrFail($id);

        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier s'il existe
            if ($td->fichier && file_exists(storage_path("app/public/{$td->fichier}"))) {
                unlink(storage_path("app/public/{$td->fichier}"));
            }

            // Enregistrement du nouveau fichier dans le stockage
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);

            // Mettre à jour le nom du fichier dans la base de données
            $td->fichier = $fileName;
        }

        $td->course_id = $request->course_id;
        $td->name = $request->name;
        $td->save();

        return redirect()->route('tds.index')->with('success', 'Travail dirigé mis à jour avec succès.');
    }

    // Supprime un travail dirigé spécifique
    public function destroy(string $id)
    {
        $td = Td::findOrFail($id);

        // Supprimer le fichier associé s'il existe
        if ($td->fichier && file_exists(storage_path("app/public/{$td->fichier}"))) {
            unlink(storage_path("app/public/{$td->fichier}"));
        }

        $td->delete();

        return redirect()->route('tds.index')->with('success', 'Travail dirigé supprimé avec succès.');
    }
}
