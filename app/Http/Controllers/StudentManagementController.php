<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\subjectGrade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\Td;
use App\Models\Tp;
use Illuminate\Foundation\Auth\User;
use Illuminate\View\View;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;


class StudentManagementController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('student.index', compact('user'));
    }

    //ayyyyaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    public function coursIndex()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer le secteur de l'utilisateur
        $sector = $user->sector;

        if (!$sector) {
            return redirect()->back()->with('error', 'Sector not found for the student.');
        }

        // Récupérer les semestres du secteur
        $semesters = $sector->semesters;

        if ($semesters->isEmpty()) {
            return redirect()->back()->with('error', 'No semesters found for the sector.');
        }

        // Initialiser un tableau pour stocker les sujets avec leurs cours, Tds et Tps
        $subjectsData = [];

        foreach ($semesters as $semester) {
            $modules = $semester->modules;

            if ($modules->isEmpty()) {
                continue;
            }

            foreach ($modules as $module) {
                $subjects = $module->subjects;

                if ($subjects->isEmpty()) {
                    continue;
                }

                foreach ($subjects as $subject) {
                    $courses = $subject->courses;

                    if ($courses->isEmpty()) {
                        continue;
                    }

                    $subjectsData[] = [
                        'subject' => $subject,
                        'courses' => $courses
                    ];
                }
            }
        }

        return view('student.Cours.cours', compact('user', 'subjectsData'));
    }
    public function download($file)
    {
        $filePath = storage_path("app/public/$file");

        if (file_exists($filePath)) {
            // Test de l'extension du fichier téléchargé
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            if ($this->isAllowedExtension($extension)) {
                // Télécharger le fichier
                return response()->download($filePath)->deleteFileAfterSend();
            } else {
                abort(403, 'Extension de fichier non autorisée.');
            }
        }

        abort(404, 'Fichier non trouvé');
    }

    private function isAllowedExtension($extension)
    {
        // Liste des extensions autorisées
        $allowedExtensions = ['txt', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf'];

        // Vérifie si l'extension est autorisée
        return in_array($extension, $allowedExtensions);
    }
    public function profile()
    {
        // Récupérer l'utilisateur en cours (professeur)
        $student = auth()->user();
        $sector = $student->sector;


        // Passer les variables à la vue
        return view('student.profile.index', compact('student', 'sector'));
    }
   //Faatiiiiiiiiiiiiiiiiiiiiima
    public function dateExamIndex()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer le secteur de l'utilisateur
        $sector = $user->sector;

        if (!$sector) {
            return redirect()->back()->with('error', 'Sector not found for the student.');
        }

        // Récupérer les semestres du secteur
        $semesters = $sector->semesters;

        if ($semesters->isEmpty()) {
            return redirect()->back()->with('error', 'No semesters found for the sector.');
        }

        // Initialiser un tableau pour stocker les modules avec leurs sujets et examens
        $modulesData = [];

        foreach ($semesters as $semester) {
            $modules = $semester->modules;

            if ($modules->isEmpty()) {
                continue;
            }

            foreach ($modules as $module) {
                $subjectsData = [];
                $subjects = $module->subjects;

                if ($subjects->isEmpty()) {
                    continue;
                }

                foreach ($subjects as $subject) {
                    $exams = $subject->exams;

                    if ($exams->isEmpty()) {
                        $subjectsData[] = [
                            'subject' => $subject,
                            'exams' => collect([])
                        ];
                    } else {
                        $subjectsData[] = [
                            'subject' => $subject,
                            'exams' => $exams
                        ];
                    }
                }

                $modulesData[] = [
                    'module' => $module,
                    'subjects' => collect($subjectsData) // Convertir en collection
                ];
            }
        }

        return view('student.DateExam.DateExamStudent', compact('user', 'modulesData'));

    }





    //wissal
    public function grades(): View
{
    $user = Auth::user();

    $subjectsGrades = SubjectGrade::with(['subject.module'])
        ->where('student_id', $user->id)
        ->get();

    if ($subjectsGrades->isEmpty()) {
        Log::channel('daily')->info('No grades found for user', ['user_id' => $user->id]);
    }

    return view('student.Grades.grades', compact('user', 'subjectsGrades'));
}
}
