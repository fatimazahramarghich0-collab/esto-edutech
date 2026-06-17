<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Td;
use App\Models\Tp;
use App\Models\Student;
use App\Models\Exam;



class SubjectController extends Controller
{


    public function showTeacherSubjects()
    {
        $user = auth()->user();

        // Assurez-vous que l'utilisateur est un enseignant
        if (!$user || !$user instanceof \App\Models\Teacher) {
            return redirect()->back()->with('error', 'Utilisateur non autorisé.');
        }

        // Récupérer les matières enseignées par le professeur
        $subjects = $user->subjects;

        // Spécifiez le chemin complet vers la vue
        return view('teacher.Document.subjects', compact('subjects'));
    }
    public function show($id)
    {
        // Charger le sujet avec ses cours
        $subject = Subject::with('courses')->findOrFail($id);

        return view('teacher.Document.Documents', compact('subject'));
    }


    public function upload(Request $request)
    {
        // Récupérer le fichier et le nom du cours depuis la requête
        $file = $request->file('file');
        $courseName = $request->input('course_name');

        if ($file) {
            // Enregistrer le fichier dans le stockage
            $filePath = '/storage/';
            $filePath .= $file->store('courses');

            // Créer un nouveau cours dans la base de données
            $course = new Course();
            $course->subject_id = $request->input('subject_id');
            $course->name = $courseName;
            $course->fichier = $filePath; // Utilisation de 'fichier' au lieu de 'file_path'
            $course->save();

            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'Cours ajouté avec succès.');
        } else {
            // Gérer le cas où aucun fichier n'a été envoyé
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
    }
// Afficher le formulaire de modification
    public function edit($id)
    {
        // Récupérer le cours par son ID
        $course = Course::findOrFail($id);

        // Retourner la vue avec le cours à modifier
        return view('teacher.Document.EditDocuments', compact('course'));
    }

    // Mettre à jour le cours
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required',
            'file' => 'required|file',
        ]);

        // Récupérer le cours par son ID
        $course = Course::findOrFail($id);

        // Mettre à jour les données du cours
        $course->name = $validatedData['name'];

        $file = $request->file('file');

        if ($file) {
            // Enregistrer le fichier dans le stockage
            $filePath = '/storage/';
            $course->fichier = $filePath . $file->store('courses');
        }

        // Sauvegarder les modifications
        $course->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Cours mis à jour avec succès.');
    }

    // Supprimer le cours
    public function destroy($id)
    {
        // Récupérer le cours par son ID et le supprimer
        $course = Course::findOrFail($id);
        $course->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Cours supprimé avec succès.');
    }
    public function showTdTp($id)
    {
        // Load the subject with its cours and their tds and tps
        $subject = Subject::with(['courses.tds', 'courses.tps'])->findOrFail($id);

        // Return the view with the subject data
        return view('teacher.Document.TdetTp', compact('subject'));
    }




    public function uploadTd(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'subject_id' => 'required|exists:subjects,id',
            'td_name' => 'required|string|max:255',
        ]);

        // Get the file and other inputs from the request
        $file = $request->file('file');
        $tdName = $request->input('td_name');
        $subjectId = $request->input('subject_id');

        if ($file) {
            $filePath = '/storage/';
            // Store the file
            $filePath .= $file->store('tds');

            // Get the course ID based on the subject ID
            $courseId = Course::where('subject_id', $subjectId)->value('id');

            if ($courseId) {
                // Create a new TD record in the database
                $td = new Td();
                $td->course_id = $courseId;
                $td->name = $tdName;
                $td->fichier = $filePath; // Store the file path
                $td->save();

                // Redirect back with a success message
                return redirect()->back()->with('success', 'TD ajouté avec succès.');
            } else {
                // Handle the case where no course is found for the subject
                return redirect()->back()->with('error', 'Aucun Td trouvé pour ce sujet.');
            }
        } else {
            // Handle the case where no file was uploaded
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
    }
    public function uploadTp(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'subject_id' => 'required|exists:subjects,id',
            'tp_name' => 'required|string|max:255',
        ]);

        // Get the file and other inputs from the request
        $file = $request->file('file');
        $tpName = $request->input('tp_name');
        $subjectId = $request->input('subject_id');

        if ($file) {
            $filePath = '/storage/';
            // Store the file
            $filePath .= $file->store('tps');

            // Get the course ID based on the subject ID
            $courseId = Course::where('subject_id', $subjectId)->value('id');

            if ($courseId) {
                // Create a new TP record in the database
                $tp = new Tp();
                $tp->course_id = $courseId;
                $tp->name = $tpName;
                $tp->fichier = $filePath; // Store the file path
                $tp->save();

                // Redirect back with a success message
                return redirect()->back()->with('success', 'TP ajouté avec succès.');
            } else {
                // Handle the case where no course is found for the subject
                return redirect()->back()->with('error', 'Erreur dans l\'joute de fichier.');
            }
        } else {
            // Handle the case where no file was uploaded
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
    }
    public function editTd(Td $td)
    {
        // Retourner la vue avec les données du TD à modifier
        return view('teacher.Document.EditTd', compact('td'));
    }

// Méthode pour supprimer un TD spécifique
    public function destroyTd(Td $td)
    {
        // Supprimer le TD de la base de données
        $td->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'TD supprimé avec succès.');
    }
    public function updateTd(Request $request, Td $td)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Mettre à jour les champs du TD
        $td->name = $request->input('name');

        // Si un fichier est téléchargé, le traiter
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier s'il existe
            if ($td->fichier) {
                Storage::delete($td->fichier);
            }

            // Enregistrer le nouveau fichier
            $td->fichier = '/storage/' . $request->file('fichier')->store('tds');
        }

        // Sauvegarder les modifications
        $td->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'TD modifié avec succès.');
    }

// Méthode pour afficher le formulaire de modification pour un TP spécifique
    public function editTp(Tp $tp)
    {
        // Retourner la vue avec les données du TP à modifier
        return view('teacher.Document.EditTp', compact('tp'));
    }

// Méthode pour supprimer un TP spécifique
    public function destroyTp(Tp $tp)
    {
        // Supprimer le TP de la base de données
        $tp->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'TP supprimé avec succès.');
    }
    public function updateTp(Request $request, Tp $tp)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Mettre à jour les champs du TP
        $tp->name = $request->input('name');

        // Si un fichier est téléchargé, le traiter
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier s'il existe
            if ($tp->fichier) {
                Storage::delete($tp->fichier);
            }

            // Enregistrer le nouveau fichier
            $tp->fichier = '/storage/' . $request->file('fichier')->store('tps');
        }

        // Sauvegarder les modifications
        $tp->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'TP modifié avec succès.');
    }

    public function ExamsStudent($id)
    {
        // Récupérer l'enseignant connecté
        $teacher = auth()->user();

        // Charger le sujet par son ID avec les examens et les étudiants associés via les relations
        $subject = Subject::where('teacher_id', $teacher->id)
            ->with(['module.semester.sector.students', 'exams'])
            ->findOrFail($id);

        // Récupérer les examens associés au sujet
        $exams = $subject->exams;

        // Récupérer les étudiants associés au sujet
        $students = $subject->module->semester->sector->students;
        // Retourner la vue avec les données des examens, du sujet et des étudiants
        return view('teacher.Document.exams', compact('subject', 'exams', 'students'));
    }



    public function storeExams(Request $request, $id)
    {
        Log::info('Request data: ', $request->all());

        $request->validate([
            'exams.*.type' => 'required|string|in:Written,Oral,Practical', // Accepter les types d'examen en anglais
            'exams.*.coefficient' => 'required|numeric',
            'exams.*.dateExam' => 'required|date',
        ]);

        $subject = Subject::findOrFail($id);

        foreach ($request->exams as $studentId => $examData) {
            $exam = new Exam([
                'subject_id' => $subject->id,
                'type' => $examData['type'], // Pas besoin de mappage, utilisez directement le type soumis
                'coefficient' => $examData['coefficient'],
                'dateExam' => $examData['dateExam'],

            ]);
            $subject->exams()->save($exam);
            Log::info('Exam saved: ', $exam->toArray());
        }

        return redirect()->back()->with('success', 'Examen ajouté avec succès.');
    }

    public function destroyExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->back()->with('success', 'Examen supprimé avec succès.');
    }

    public function pageAdd($id)
    {
        // Load the subject with its cours and their tds and tps
        $subject = Subject::with(['courses.tds', 'courses.tps'])->findOrFail($id);

        // Return the view with the subject data
        return view('teacher.Document.addTdTp', compact('subject'));
    }

}

