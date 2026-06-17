<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Module;
use App\Models\Sector;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Semester;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\ModuleGrade;
use App\Models\SubjectGrade;
use Illuminate\Http\Request;
use App\Models\SemesterGrade;
use App\Models\HourlyLoad;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherManagementController extends Controller
{

 // Method to update the teacher's profile



    public function index(): View
    {
        return view('teacher.index');
    }

    //Ayaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa


    // app\Http\Controllers\TeacherManagementController.php

    public function ChefFilIndex()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est Chef de filière
        $sector = Sector::where('ChefFil', $user->name)->first();

        if (!$sector) {
            return view('teacher.EnseignantChefFil.ChefFil', ['semesters' => [], 'sector' => null])->with('error', 'Aucun secteur trouvé pour cet utilisateur.');
        }

        // Récupérer les semestres de la filière avec les modules et les matières
        $semesters = Semester::where('sector_id', $sector->id)->with('modules.subjects.teacher')->get();

        // Récupérer tous les enseignants disponibles
        $teachers = Teacher::all();

        return view('teacher.EnseignantChefFil.ChefFil', compact('semesters', 'sector', 'teachers', 'user'));
    }


    //Abderrahim
    public function getChefDepIndex()
    {
        $user = Auth()->user();
        $teachers = Teacher::simplePaginate(5);

        return view('teacher.ChefDepartment.index', ['teachers' => $teachers, 'user' => $user]);
    }

    public function assignTeacherToSubject(Request $request, $subjectId)
    {
        // Valider les données du formulaire
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Récupérer le sujet
        $subject = Subject::findOrFail($subjectId);

        // Attribuer le professeur au sujet
        $subject->teacher_id = $request->teacher_id;
        $subject->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Enseignant attribué avec succès à la matière.');
    }
    //Ayoub
    public function profile()
    {
        // Récupérer l'utilisateur en cours (professeur)
        $user = auth()->user();

        // Récupérer les matières enseignées par le professeur
        $subjects = $user->subjects;

        // Récupérer les charges horaires pour chaque matière
        //$hourlyLoads = $user->hourlyLoads()->with('subject')->get();
        $teacherCharges = $user->hourlyLoads;        
        // Passer les variables à la vue
        return view('teacher.profile.index', compact('user', 'subjects', 'teacherCharges'));
    }


    public function getStudents($subjectId)
    {
        // Récupérez le sujet spécifique
        $subject = Subject::findOrFail($subjectId);
    
        // Récupérez les étudiants associés à ce sujet à travers les relations
        $students = $subject->module->semester->sector->students;
    
        // Passez les étudiants récupérés à la vue
        return view('teacher.notes', ['subject' => $subject, 'students' => $students]);
}


    public function saveNotes(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'semester_note' => 'array',
            'module_note' => 'array',
            'subject_note' => 'array',
            'semester_note.*' => 'numeric|nullable',
            'module_note.*' => 'numeric|nullable',
            'subject_note.*' => 'numeric|nullable',
        ]);

        $subject_id = $request->input('subject_id');

        foreach ($data['semester_note'] as $studentId => $note) {
            if ($note !== null) {
                SemesterGrade::updateOrCreate(
                    ['student_id' => $studentId, 'semester_id' => 1], // Remplacez '1' par l'ID réel du semestre
                    ['note' => $note]
                );
            }
        }

        foreach ($data['module_note'] as $studentId => $note) {
            if ($note !== null) {
                ModuleGrade::updateOrCreate(
                    ['student_id' => $studentId, 'module_id' => 1], // Remplacez '1' par l'ID réel du module
                    ['noteModule' => $note]
                );
            }
        }

        foreach ($data['subject_note'] as $studentId => $note) {
            if ($note !== null) {
                SubjectGrade::updateOrCreate(
                    ['student_id' => $studentId, 'subject_id' => $subject_id],
                    ['note' => $note]
                );
            }
        }

        return redirect()->route('teacher.notes', ['subject_id' => $subject_id])->with('success', 'Notes enregistrées avec succès.');
    }


    //wissal
    public function teachers(): View
    {
        $user = auth()->user();
        $teachers = Teacher::with('subjects')->get();
        return view('teacher.HourlyLoadsManag', compact('user', 'teachers'));
    }

    public function Documents(): View
    {
        return view('teacher.Document.Documents');
    }


    public function getAbsences(): View
    {
        $user = auth()->user();
        $subjects = Subject::whereHas('teacher', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get();
        return view('teacher.absences', compact('subjects', 'user'));
    }
    public function AffNotes(): View
    {
        $user = auth()->user();
        $subjects = Subject::whereHas('teacher', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get();
        return view('teacher.notes', compact('subjects', 'user'));
    }
    
}
