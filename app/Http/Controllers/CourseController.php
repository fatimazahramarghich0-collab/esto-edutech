<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }


    public function create()
    {
        // Affiche le formulaire de création d'un nouveau cours
        return view('courses.create');
    }

    
    public function store(Request $request)
    {
        // Valide les données du formulaire envoyé par l'utilisateur
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:255',
            'fichier' => 'required|file',
        ]);

        // Stocke le fichier envoyé dans un répertoire spécifique
        $file = $request->file('fichier')->store('cours');

        // Crée un nouveau cours dans la base de données avec les données validées
        Course::create([
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'fichier' => $file,
        ]);

        return redirect()->route('courses.index')->with('success', 'Cours créé avec succès.');
    }

 
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

 
    // public function edit(Course $course)
    // {
    //     // Affiche le formulaire pour modifier un cours spécifique
    //     return view('courses.edit', compact('course'));
    // }


    public function update(Request $request, Course $course)
    {
        // Valide les données du formulaire de modification envoyé par l'utilisateur
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:255',
            'fichier' => 'nullable|file',
        ]);

        // Met à jour les informations du cours dans la base de données avec les données validées
        $course->update([
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'fichier' => $request->hasFile('fichier') ? $request->file('fichier')->store('cours') : $course->fichier,
        ]);

        return redirect()->route('courses.index')->with('success', 'Cours mis à jour avec succès.');
    }

   
    public function destroy(Course $course)
    {
        // Supprime le cours spécifique de la base de données
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Cours supprimé avec succès.');
    }
}
