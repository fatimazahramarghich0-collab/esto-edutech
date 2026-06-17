<?php

namespace App\Http\Controllers;

use App\Models\SubjectGrade;
use Illuminate\Http\Request;

class SubjectGradeController extends Controller
{
    // Affiche la liste des notes de matière
    public function index()
    {
        $subjectGrades = SubjectGrade::all();
        return view('subject_grades.index', compact('subjectGrades'));
    }

    // Affiche le formulaire de création d'une note de matière
    public function create()
    {
        return view('subject_grades.create');
    }

    // Enregistre une nouvelle note de matière
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id', // Supposons que vous avez une table "students" avec une clé primaire "id"
            'note' => 'required|numeric|min:0|max:20',
        ]);

        SubjectGrade::create($request->all());

        return redirect()->route('subjectGrades.index')->with('success', 'Note de matière créée avec succès.');
    }

    // Affiche les détails d'une note de matière spécifique
    public function show($id)
    {
        $subjectGrade = SubjectGrade::findOrFail($id);
        return view('subject_grades.show', compact('subjectGrade'));
    }

    // Affiche le formulaire d'édition d'une note de matière spécifique
    public function edit($id)
    {
        $subjectGrade = SubjectGrade::findOrFail($id);
        return view('subject_grades.edit', compact('subjectGrade'));
    }

    // Met à jour une note de matière spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id', // Supposons que vous avez une table "students" avec une clé primaire "id"
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $subjectGrade = SubjectGrade::findOrFail($id);
        $subjectGrade->update($request->all());

        return redirect()->route('subjectGrades.index')->with('success', 'Note de matière mise à jour avec succès.');
    }

    // Supprime une note de matière spécifique
    public function destroy($id)
    {
        $subjectGrade = SubjectGrade::findOrFail($id);
        $subjectGrade->delete();

        return redirect()->route('subjectGrades.index')->with('success', 'Note de matière supprimée avec succès.');
    }
}
