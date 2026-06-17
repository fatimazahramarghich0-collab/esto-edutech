<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Sector;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    public function updateA(Request $request, int $idStudent)
    {
        $student = Student::find($idStudent);
    
        $student = Student::find($idStudent);

        $request->validate([
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable|email|unique:students,email,' . $student->id . '|max:255',
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = [];

        if($request->filled('name'))
        {
            $data[ 'name' ] = $request->name;
        }

        if($request->filled('email'))
        {
            $data[ 'email' ] = $request->email;
        }

        if($request->filled('password'))
        {
            $data[ 'password' ] = bcrypt($request->password);
        }

        if($request->hasFile('photo'))
        {
            $imagePath = '/storage/';
            $imagePath .= $request->file('photo')->store('student_images');

            $data[ 'photo' ] = $imagePath;
        }

        $student->update($data);

        Auth::loginUsingId($student->id);

        return redirect()->route('student.profile')->with('success', 'Profil étudiant mis à jour.');
    }

    public function show($id)
    {
        $user = auth()->user();

        $student = Student::findOrFail($id);

        return view('admin.Pages.students.show', compact('user', 'student'));
    }


    public function edit($id)
    {
        $user = auth()->user();

        $student = Student::findOrFail($id);

        return view('admin.Pages.students.edit', compact('user', 'student'));
    }

    public function editSector($id)
    {
        $user = auth()->user();

        $student = Student::findOrFail($id);
        $sectors = Sector::all();
        return view('admin.Pages.students.edit_sector', compact('user', 'student', 'sectors'));
    }


    public function update(Request $request, $id)
    {
        if($request->has('sector_id'))
        {
            $request->validate([
                'sector_id' => 'required|exists:sectors,id',
            ]);

            $student = Student::findOrFail($id);
            $student->sector_id = $request->input('sector_id');
            $student->save();

            return redirect()->back()->with('success', 'Secteur mis à jour avec succès.');
        }

        $request->validate([
            'name'       => 'nullable|string|max:255',
            'email'      => 'nullable|email',
            'dateNaissance' => 'nullable|date',
            'codeApogee' => 'nullable|string|max:255|unique:students,codeApogee,' . $id,
            'sellphone'  => 'nullable|string|max:255',
        ]);

        $student = Student::findOrFail($id);

        $data = [];

        if($request->filled('name'))
        {
            $data[ 'name' ] = $request->input('name');
        }

        if($request->filled('email'))
        {
            $data[ 'email' ] = $request->input('email');
        }

        if($request->filled('dateNaissance'))
        {
            $data[ 'dateNaissance' ] = $request->input('dateNaissance');
        }

        if($request->filled('codeApogee'))
        {
            $data[ 'codeApogee' ] = $request->input('codeApogee');
        }

        if($request->filled('sellphone'))
        {
            $data[ 'sellphone' ] = $request->input('sellphone');
        }


        if($request->hasFile('photo'))
        {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif',
            ]);
            $photo = '/storage/';

            $photo .= $request->file('photo')->store('student_images');
            $data[ 'photo' ] = $photo;
        }

        $student->update($data);

        return redirect()->route('students')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function create()
    {
        $sectors = Sector::all();

        return view('admin.Pages.students.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $validatedAttributes = $request->validate([
            'sector_id'  => 'required|exists:sectors,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email',
            'password'   => 'required|string|min:8',
            'dateNaissance' => 'required|date',
            'CodeMassar' => 'required|string|max:255|unique:students,CodeMassar',
            'codeApogee' => 'required|string|max:255|unique:students,codeApogee',
            'sellphone'  => 'required|string|max:255',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        try
        {
            $photo = '/storage/';
            $photo .= $request->file('photo')->store('student_images');

            Student::create([
                'sector_id'     => $validatedAttributes[ 'sector_id' ],
                'name'          => $validatedAttributes[ 'name' ],
                'email'         => $validatedAttributes[ 'email' ],
                'password'      => bcrypt($validatedAttributes[ 'password' ]),
                'dateNaissance' => $validatedAttributes[ 'dateNaissance' ],
                'CodeMassar'    => $validatedAttributes[ 'CodeMassar' ],
                'codeApogee'    => $validatedAttributes[ 'codeApogee' ],
                'sellphone'     => $validatedAttributes[ 'sellphone' ],
                'photo'         => $photo,
            ]);

            return redirect()->route('students')->with('success', 'Étudiant créé avec succès.');
        } catch (\Exception $e)
        {
            Log::error('Failed to create student: ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create student.']);
        }
    }

    public function importCSV()
    {
        $sectors = Sector::all();
        Log::channel('daily')->info('rani flmethod ta3 lmodal view');

        return view('admin.Pages.students.import', compact('sectors'));
    }

    public function import(Request $request)
    {
        Log::channel('daily')->info('Entered import method');

        $request->validate([
            'file' => 'required|mimes:csv,txt',
            'sector_id' => 'required|exists:sectors,id'
        ]);
        Log::channel('daily')->info('Validation passed');

        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        Log::channel('daily')->info('File Contents:', $fileContents);

        $sectorId = $request->input('sector_id');
        Log::channel('daily')->info('Selected sector ID:', ['sector_id' => $sectorId]);

        foreach ($fileContents as $line)
        {
            $data = str_getcsv($line);

            Log::channel('daily')->info('Processing line:', $data);

            try
            {
                $photoUrl = $data[ 7 ];
                $photoContents = file_get_contents($photoUrl);
                $photoPath = 'student_images/' . basename($photoUrl);

                Storage::disk('local')->put($photoPath, $photoContents);
                Log::channel('daily')->info('Photo stored:', ['url' => $photoUrl, 'path' => $photoPath]);

                Student::create([
                    'name'          => $data[ 0 ],
                    'email'         => $data[ 1 ],
                    'dateNaissance' => $data[ 2 ],
                    'password'      => $data[ 3 ],
                    'CodeMassar'    => $data[ 4 ],
                    'codeApogee'    => $data[ 5 ],
                    'sellphone'     => $data[ 6 ],
                    'sector_id'     => $sectorId,
                    'photo'         => $photoPath,
                ]);
                Log::channel('daily')->info('Student created:', ['name' => $data[ 0 ], 'email' => $data[ 1 ]]);
            } catch (\Exception $e)
            {
                Log::channel('daily')->error('Error creating student:', ['error' => $e->getMessage(), 'data' => $data]);
                return response()->json(['success' => false, 'message' => 'An error occurred while creating a student: ' . $e->getMessage()]);
            }
        }

        Log::channel('daily')->info('Completed import process');

        return response()->json(['success' => true, 'message' => 'Etudiants importés avec succès']);
    }



    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Étudiant supprimé avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $students = Student::where('name', 'LIKE', "%{$query}%")
            ->orWhere('codeApogee', 'LIKE', "%{$query}%")
            ->orWhereHas('sector', function ($q) use ($query)
            {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();

        $output = '';

        if(count($students) > 0)
        {
            foreach ($students as $student)
            {
                $output .= '<tr>' .
                    '<td>' .
                    '<div class="d-flex px-2 py-1">' .
                    '<div>' .
                    '<img src="' . asset($student->photo) . '" class="avatar avatar-sm me-3" alt="user1">' .
                    '</div>' .
                    '<div class="d-flex flex-column justify-content-center">' .
                    '<h6 class="mb-0 text-sm">' . $student->name . '</h6>' .
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
                    '<span class="text-secondary text-xs font-weight-bold">' . $student->sector->name . '</span>' .
                    '</td>' .
                    '<td class="align-middle text-center">' .
                    '<span class="text-secondary text-xs font-weight-bold">' . $student->CodeMassar . '</span>' .
                    '</td>' .
                    '<td class="align-middle justify-content-center">' .
                    '<div class="d-flex">' .
                    '<a class="dropdown-item" href="' . route('students.show', $student->id) . '" title="Consulter"><i class="fa-solid fa-eye"></i></a>' .
                    '<a class="dropdown-item" href="#" data-id="' . $student->id . '" onclick="GetUpdateStudent(' . $student->id . ', event)" title="Modifier"><i class="fa-solid fa-pen-to-square"></i></a>' .
                    '</div>' .
                    '</td>' .
                    '</tr>';
            }
        } else
        {
            $output = '<tr>' .
                '<td colspan="6" class="text-center">No students found</td>' .
                '</tr>';
        }

        return response()->json($output);
    }

    public function getAbsences($id)
    {
        $student = Student::with('absence.subject')->findOrFail($id);
        $totalAbsences = $student->absence->count();

        return view('admin.Pages.students.absence', compact('student', 'totalAbsences'));
    }

    public function getSemesterGrades($id)
    {
        $student = Student::with([
            'semestreGrade' => function ($query)
            {
                $query->with('semester')->select('id', 'student_id', 'semester_id', 'note');
            }
        ])->findOrFail($id);

        return view('admin.Pages.students.semesterGrades', compact('student'));
    }

    public function getAbsencesAbd($id)
    {

        $absentSubjects = Absence::where('student_id', $id)->pluck('subject_id')->unique();

        $subjects = Subject::with([
            'absence' => function ($query) use ($id)
            {
                $query->where('student_id', $id);
            }, 'teacher'
        ])->whereIn('id', $absentSubjects)->get();

        return view('student.absence.index', compact('subjects'));
    }
}
