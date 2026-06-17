<?php

namespace App\Http\Controllers;

use App\Models\ExamGrade;
use Illuminate\Http\Request;

class ExamGradeController extends Controller
{
    // Affiche la liste des notes d'examen
    public function index()
    {
        $examGrades = ExamGrade::all();
        return view('exam_grades.index', compact('examGrades'));
    }

    // Affiche le formulaire de création d'une note d'examen
    public function create()
    {
        return view('exam_grades.create');
    }

    // Enregistre une nouvelle note d'examen
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id', // Supposons que vous avez une table "students" avec une clé primaire "id"
            'note' => 'required|numeric|min:0|max:20',
        ]);

        ExamGrade::create($request->all());

        return redirect()->route('examGrades.index')->with('success', 'Note d\'examen créée avec succès.');
    }

    // Affiche les détails d'une note d'examen spécifique
    public function show($id)
    {
        $examGrade = ExamGrade::findOrFail($id);
        return view('exam_grades.show', compact('examGrade'));
    }

    // Affiche le formulaire d'édition d'une note d'examen spécifique
    public function edit($id)
    {
        $examGrade = ExamGrade::findOrFail($id);
        return view('exam_grades.edit', compact('examGrade'));
    }

    // Met à jour une note d'examen spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id', // Supposons que vous avez une table "students" avec une clé primaire "id"
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $examGrade = ExamGrade::findOrFail($id);
        $examGrade->update($request->all());

        return redirect()->route('examGrades.index')->with('success', 'Note d\'examen mise à jour avec succès.');
    }

    // Supprime une note d'examen spécifique
    public function destroy($id)
    {
        $examGrade = ExamGrade::findOrFail($id);
        $examGrade->delete();

        return redirect()->route('examGrades.index')->with('success', 'Note d\'examen supprimée avec succès.');
    }
//Ayoub
    public function saveNotes(Request $request)
    {
        $notes = $request->all();

        foreach ($notes as $studentId => $exams) {
            foreach ($exams as $examId => $note) {
                ExamGrade::updateOrCreate(
                    ['student_id' => $studentId, 'exam_id' => $examId],
                    ['note' => $note]
                );
            }
        }

        // Répondre avec un message JSON
        return response()->json(['success' => true, 'message' => 'Notes enregistrées avec succès'], 200);
    }
}
