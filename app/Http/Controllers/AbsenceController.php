<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;


class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::all();
        return view('absences.index', compact('absences'));
    }

    public function show($id)
    {
        $absence = Absence::findOrFail($id);
        return view('absences.show', compact('absence'));
    }

    public function create()
    {
        return view('absences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Définir les règles de validation pour les données du formulaire
        ]);

        Absence::create([
            // Attribuer les valeurs des champs du formulaire aux attributs du modèle Absence
        ]);

        return redirect()->route('absences.index')->with('success', 'Absence created successfully!');
    }

    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        return view('absences.edit', compact('absence'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Définir les règles de validation pour les données du formulaire
        ]);

        $absence = Absence::findOrFail($id);
        $absence->update([
            // Attribuer les valeurs des champs du formulaire aux attributs du modèle Absence
        ]);

        return redirect()->route('absences.index')->with('success', 'Absence updated successfully!');
    }

    public function destroy($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();
        return redirect()->route('absences.index')->with('success', 'Absence deleted successfully!');
    }
}
