<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Module;
use App\Models\Absence;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ExamGrade;

use App\Models\Department;
use App\Models\HourlyLoad;
use App\Models\ModuleGrade;
use App\Models\SubjectGrade;
use Illuminate\Http\Request;
use App\Models\SemesterGrade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TeacherController extends Controller
{
    //------------------------------------------Abderrahim's methods-----------------------------------------------------
    //Ne touch pass, je suis sérieux na9talkum                 a la gi dahak mais matouchiwch l code pleas


    //Abderrahim
    function deleteA($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->delete()) {
            return 'success';
        } else {
            return 'error';
        }
    }

    //Abderrahim
    function storeA(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name'          => ['required', 'string', 'max:100', 'min:5', 'regex:/^[\pL\s\-]+$/u'],
                'password'      => ['required', 'string', 'min:8', 'max:100', 'confirmed'],
                'email'         => ['required', 'string', 'min:5', 'max:150', 'email:rfc,dns', 'unique:teachers,email'],
                'dateNaissance' => ['nullable', 'date', 'before:today'],
                'chefDep'       => ['required', 'in:true,false'],
                'chefFil'       => ['required', 'in:true,false'],
                'sellphone'     => ['nullable', 'digits:10', 'regex:/^(06|05|07)\d{8}$/'],
                'photo'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
            ],
            [
                'sellphone.regex' => 'Le numéro de téléphone doit commencer par 06, 05 ou 07 et être suivi de 8 chiffres.'
            ]
        );

        //Abderrahim
        $photPath = $request->file('photo')->store('teacher_images');

        Teacher::created([
            'name'          => $validatedData['name'],
            'password'      => $validatedData['password'],
            'email'         => $validatedData['email'],
            'dateNaissance' => $validatedData['dateNaissance'],
            'chefDep'       => $validatedData['chefDep'],
            'chefFil'       => $validatedData['chefFil'],
            'sellphone'     => $validatedData['sellphone'],
            'photo'         => $photPath,
        ]);

        return back()->with('success', 'L\'enseignant a été ajouté avec success');
    }

    //Abderrahim
    function updateAbde(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name'          => ['nullable', 'string', 'max:100', 'min:5', 'regex:/^[\pL\s\-]+$/u'],
                'password'      => ['nullable', 'string', 'min:8', 'max:100', 'confirmed'],
                'email'         => ['nullable', 'string', 'min:5', 'max:150', 'email:rfc,dns', Rule::unique('teachers')->ignore($request->id)],
                'dateNaissance' => ['nullable', 'date', 'before:today'],
                'chefDep'       => ['nullable', 'in:true,false'],
                'chefFil'       => ['nullable', 'in:true,false'],
                'sellphone'     => ['nullable', 'digits:10', 'regex:/^(06|05|07)\d{8}$/'],
                'photo'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
            ],
            [
                'sellphone.regex' => 'Le numéro de téléphone doit commencer par 06, 05 ou 07 et être suivi de 8 chiffres.'
            ]
        );


        $teacher = Teacher::findOrFail($request->id);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $validatedData['name'];
        }

        if ($request->filled('email')) {
            $data['email'] = $validatedData['email'];
        }

        if ($request->filled('password')) {
            $data['password'] = $validatedData['password'];
        }

        if ($request->filled('chefFil')) {
            $data['chefFil'] = $validatedData['chefFil'];
        }

        if ($request->filled('chefDep')) {
            $data['chefDep'] = $validatedData['chefDep'];
        }

        if ($request->filled('sellphone')) {
            $data['sellphone'] = $validatedData['sellphone'];
        }

        if ($request->filled('dateNaissance')) {
            $data['dateNaissance'] = $validatedData['dateNaissance'];
        }

        if ($request->filled('photo')) {
            $photPath = "/storage/";

            $photPath .= $request->file('photo')->store('teacher_images');

            $data['name'] = $photPath;
        }

        $teacher->update($data);

        $teachers = Teacher::simplePaginate(6);

        $success = 'L\'enseignant a été mis à jour avec succès.';

        return redirect()->back()->with(['success' => $success]);
    }

    //-------------------------------------------------------------------------------------------------------------------


    function updateA(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id); // Assuming the teacher is authenticated

        $request->validate([
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable|email|unique:teachers,email,' . $teacher->id . '|max:255',
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('email')) {
            $data['email'] = $request->email;
        }

        // Update password only if it's provided
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $imagePath = "/storage/";

            $imagePath .= $request->file('photo')->store('teacher_images');

            $data['photo'] = $imagePath;
        }

        $teacher->update($data);

        return redirect()->route('teacher.profile')->with('success', 'Le profil de l\'enseignant a été mis à jour.');
    }


    //Show form edit teacher
    function editA($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teacher.ChefDepartment.edit', compact('teacher'));
    }

    //partie charge horaire

    function showTeacherLoads()
    {
        $teachers = Teacher::with('subjects')->get();
        $subjects = Subject::all();

        $teacherCharges = Teacher::with('hourlyLoads')->get();

        return view('teacher.HourlyLoad.createHourlyLoad', compact('teachers', 'subjects', 'teacherCharges'));
    }

    public function storeHourlyLoad(Request $request)
    {
        try {
            Log::channel('daily')->info('Entered the store method');

            $request->validate([
                'subject_id' => 'required|exists:subjects,id',
                'cm' => 'required|numeric|min:0',
                'td' => 'required|numeric|min:0',
                'tp' => 'required|numeric|min:0',
            ]);
            Log::channel('daily')->info('Validation passed');

            $subject = Subject::findOrFail($request->subject_id);
            Log::channel('daily')->info('Found subject: ', ['subject' => $subject]);

            $teacher = $subject->teacher;
            Log::channel('daily')->info('Found teacher: ', ['teacher' => $teacher]);

            // Update the subject with the new hours

            $cm_hours = $request->cm * 1.5;
            $td_hours = $request->td * 1;
            $tp_hours = $request->tp * 0.75;
            $total_hours = $cm_hours + $td_hours + $tp_hours;
            Log::channel('daily')->info('Total hours calculated: ', ['total' => $total_hours]);

            $existing_charge = $teacher->hourlyLoads()->sum('charge');
            $new_total_charge = $existing_charge + $total_hours;

            if ($new_total_charge > 48) {
                Log::channel('daily')->info('Total charge exceeds 48 hours');

                return redirect()->back()->with('error', 'La charge horaire totale dépasse la limite de 48 heures.');
            } else {
                $subject->nb_cm = $request->cm;
                $subject->nb_td = $request->td;
                $subject->nb_tp = $request->tp;
                $subject->save();

                // Add the total hours to the hourlyloads table
                HourlyLoad::create([
                    'teacher_id' => $teacher->id,
                    'charge' => $total_hours,
                ]);
                Log::channel('daily')->info('Hourly load created successfully');
            }

            return redirect()->back()->with('success', 'Charge horaire ajoutée avec succès.');
        } catch (\Exception $e) {
            Log::channel('daily')->error('An error occurred while storing the hourly load: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s est produite lors de l\'enregistrement de la charge horaire: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $teachers = Teacher::all();


        return view('admin.Pages.teachers', compact('teachers'));
    }


    function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:teachers,email',
            'password'      => 'required|min:8|confirmed',
            'dateNaissance' => 'nullable|date',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'StatusDep'     => 'required|string|in:true,false',
            'StatusFil'     => 'required|string|in:true,false',
            'sellphone'     => 'nullable|string',
        ]);
        if ($request->password !== $request->password_confirmation) {
            return back()->withInput()->withErrors('The password confirmation does not match.');
        }

        try {
            $teacher = new Teacher();
            $teacher->name = $validatedData['name'];
            $teacher->email = $validatedData['email'];
            $teacher->password = bcrypt($validatedData['password']);
            $teacher->dateNaissance = $validatedData['dateNaissance'];
            if ($request->hasFile('photo')) {
                $photoPath = '/storage/';
                $photoPath .= $request->file('photo')->store('teacher_images');
                $teacher->photo = $photoPath;
            }
            // if ($request->hasFile('photo')) {
            //     $photo = $request->file('photo');
            //     $photoName = time() . '_' . $photo->getClientOriginalName();
            //     $photo->move(public_path('photos'), $photoName);
            //     $teacher->photo = $photoName;
            // }
            $teacher->StatusDep = $validatedData['StatusDep'];
            $teacher->StatusFil = $validatedData['StatusFil'];

            $teacher->sellphone = $validatedData['sellphone'];
            $teacher->save();


            $teachers = Teacher::all();

            return view('admin.Pages.teachers', compact('teachers'))->with('success', 'Teacher created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('An error occurred while creating the teacher. Please try again.');
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $departments = Department::all();
        return view('admin.Pages.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'dateNaissance' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'StatusDep' => 'required|string|in:oui,non',
            'StatusFil' => 'required|string|in:oui,non',
            'sellphone' => 'nullable|string',
        ]);


        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->name = $request->input('name');
            $teacher->email = $request->input('email');
            $teacher->StatusDep = $request->input('StatusDep');
            $teacher->StatusFil = $request->input('StatusFil');
            $teacher->dateNaissance = $request->input('dateNaissance');
            $teacher->sellphone = $request->input('sellphone');
            $teacher->save();

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('An error occurred while updating the teacher. Please try again.');
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
    public function showDepartments()
    {
        return view('admin.Pages.teachersDepart');
    }
    public function showDepartmentsForm()
    {
        $dSe = Department::all();
        return view('admin.Pages.department.index', compact('dSe'));
    }


    public function searchStudents(Request $request)
    {
        try {
            $query = $request->get('query');
            $subjectId = $request->get('subject_id');
            $subject = Subject::with('teacher')->findOrFail($subjectId);
            if ($subject->teacher_id !== Auth::id()) {
                return response()->json('<tr><td colspan="4" class="text-center">Unauthorized</td></tr>');
            }
            $students = Student::whereHas('subjectGrade', function ($q) use ($subjectId) {
                $q->where('subject_id', $subjectId);
            })->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('codeApogee', 'LIKE', "%{$query}%");
            })->get();
            $output = '';
            if ($students->count() > 0) {
                foreach ($students as $student) {
                    $output .= '<tr>' .
                        '<td>' .
                        '<div class="d-flex px-2 py-1">' .
                        '<div>' .
                        '<img src="' . asset($student->photo) . '" class="avatar avatar-sm me-3" alt="' . $student->name . '">' .
                        '</div>' .
                        '<div class="d-flex flex-column justify-content-center">' .
                        '<h6 class="mb-0 text-sm"><a href="#" class="student-link" data-id="' . $student->id . '" data-name="' . $student->name . '">' . $student->name . '</a></h6>' .
                        '</div>' .
                        '</div>' .
                        '</td>' .
                        '<td>' .
                        '<p class="text-xs font-weight-bold mb-0">#' . $student->codeApogee . '</p>' .
                        '</td>' .
                        '<td class="align-middle text-center text-sm">' .
                        '<p class="text-xs font-weight-bold mb-0">' . $student->dateNaissance . '</p>' .
                        '</td>' .
                        '<td class="align-middle text-center">' .
                        '<div class="form-check " style="display: flex; justify-content: center">' .
                        '<input class="form-check-input" type="checkbox" name="attendance[' . $student->id . ']" value="1" id="attendance-' . $student->id . '">' .
                        '</div>' .
                        '</td>' .
                        '</tr>';
                }
            } else {
                $output = '<tr>' .
                    '<td colspan="4" class="text-center">No students found</td>' .
                    '</tr>';
            }
            return response()->json($output);
        } catch (\Exception $e) {
            // Log the error
            Log::channel('daily')->error('Error in searchStudents method: ' . $e->getMessage());
            // Return error response
            return response()->json('<tr><td colspan="4" class="text-center">An error occurred. Please try again later.</td></tr>');
        }
    }
    //Ayoub
    public function ListStudents(Request $request)
    {
        try {
            // Récupère les paramètres de la requête
            $query = $request->get('query');
            $subjectId = $request->get('subject_id');

            // Récupère le sujet avec le professeur associé
            $subject = Subject::with('teacher')->findOrFail($subjectId);

            // Vérifie si le professeur authentifié est bien celui associé au sujet
            if ($subject->teacher_id !== Auth::id()) {
                return response()->json('<tr><td colspan="6" class="text-center">Unauthorized</td></tr>');
            }

            // Récupère les étudiants associés au sujet et filtre par nom ou codeApogee
            $students = Student::whereHas('subjectGrade', function ($q) use ($subjectId) {
                $q->where('subject_id', $subjectId);
            })->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('codeApogee', 'LIKE', "%{$query}%");
            })->get();

            // Récupère les examens associés au sujet
            $exams = Exam::where('subject_id', $subjectId)->get();

            // Initialise la sortie HTML
            $output = '';

            if ($students->count() > 0) {
                foreach ($students as $student) {
                    $output .= '<tr>' .
                        '<td>' .
                        '<div class="d-flex px-2 py-1">' .
                        '<div>' .
                        '<img src="' . asset($student->photo) . '" class="avatar avatar-sm me-3" alt="' . $student->name . '">' .
                        '</div>' .
                        '<div class="d-flex flex-column justify-content-center">' .
                        '<h6 class="mb-0 text-sm"><a href="#" class="student-link" data-id="' . $student->id . '" data-name="' . $student->name . '">' . $student->name . '</a></h6>' .
                        '</div>' .
                        '</div>' .
                        '</td>' .
                        '<td>' .
                        '<p class="text-xs font-weight-bold mb-0">#' . $student->codeApogee . '</p>' .
                        '</td>' .
                        '<td class="align-middle text-center text-sm">' .
                        '<p class="text-xs font-weight-bold mb-0">' . $student->dateNaissance . '</p>' .
                        '</td>' .
                        '<td class="align-middle text-center">';

                    // Ajouter les examens et les champs de notes dans une seule cellule
                    foreach ($exams as $exam) {
                        $output .= '<div class="mb-2 d-flex flex-column align-items-center">' .
                            '<p class="text-xs font-weight-bold mb-0">' . $exam->type . '</p>' .
                            '<input type="number" min="0" max="20" name="exam_note[' . $student->id . '][' . $exam->id . ']" class="form-control form-control-sm" style="width: 70px;" step="0.01">' .
                            '<span class="error-message" style="color: red;"></span>' .
                            '</div>';
                    }

                    $output .= '</td>' .
                        '</tr>';
                }
            } else {
                $output = '<tr>' .
                    '<td colspan="6" class="text-center">No students found</td>' .
                    '</tr>';
            }

            // Retourne la réponse JSON
            return response()->json($output);
        } catch (\Exception $e) {
            // Log the error
            Log::channel('daily')->error('Error in ListStudents method: ' . $e->getMessage());

            // Return error response
            return response()->json('<tr><td colspan="6" class="text-center">An error occurred. Please try again later.</td></tr>');
        }
    }
    public function markAttendance(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $attendance = $request->input('attendance', []);
        $date = now()->format('Y-m-d');

        foreach ($attendance as $studentId => $value) {
            foreach ($attendance as $studentId => $value) {
                Absence::create([
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'dateAbsence' => $date,
                ]);
            }

            return redirect()->back()->with('success', 'Absences marquées avec succès.');
        }
    }

    public function cancelAbsence(Request $request)
    {
        try {
            $studentId = $request->input('student_id');

            $absence = Absence::where('student_id', $studentId)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($absence) {
                $absence->delete();
                return response()->json(['success' => true, 'message' => 'Absence a été supprimé avec succès.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Pas d\'absences aujourd\'hui.']);
            }
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in cancelAbsence method: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
