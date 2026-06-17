<?php
namespace App\Http\Controllers;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Module;
use App\Models\Student;
use App\Models\Subject;

use App\Models\Message;


class AdminManagementController extends Controller
{
    public function index(Request $request): View
{
    $user = Auth::user();

    // Récupérer tous les messages avec les attributs spécifiés
    $messages = Message::select('id', 'name', 'surname', 'email', 'message', 'created_at', 'estLu')
        ->paginate(6);

    // Récupérer le nombre de messages lus
    $nombreMessagesLus = Message::where('estLu', true)->count();

    // Récupérer le nombre de messages non lus
    $nombreMessagesNonLus = Message::where('estLu', false)->count();

    // Récupérer le nombre total de messages
    $totalMessages = Message::count();

    $nbrSubjects = Subject::count();
    $nbrTeachers = Teacher::count();
    $nbrStudents = Student::count();

    return view('admin.index', compact('user', 'nbrSubjects', 'nbrTeachers', 'nbrStudents', 'messages', 'nombreMessagesNonLus', 'nombreMessagesLus', 'totalMessages'));
}


    /*---------------------------------------------------- Étudiants ---------------------------------------------------*/

    public function students(): View
    {
        $students = Student::select('id', 'photo', 'name', 'codeApogee', 'dateNaissance', 'CodeMassar','sector_id', 'email', 'sellphone', 'noteDiplome')
            ->with('sector')
            ->get();

        $user = Auth()->user();

        $students = Student::paginate(5);
        return view('admin.Pages.students', compact('user','students'));
    }



    /*---------------------------------------------------- Personal ----------------------------------------------------*/
    public function staff(): View
    {
        $user = Auth::user();

        return view('admin.Pages.staff',compact('user'));
    }


    /*--------------------------------------------------- Department ---------------------------------------------------*/

    public function departments(): View
    {
        $user = Auth::user();

        $DepartmentController = new DepartmentController();

        $departments = $DepartmentController->index();

        return view('admin.Pages.department.index', compact('user','departments'));
    }

    public function profile(): View
    {
        $user = Auth::user();

        return view('admin.Pages.profile.index', compact('user'));
    }



    /*-------------------------------------------- Filiéres-------------------------------------------------------------*/

    public function sector(SectorController $sectorController)
    {

        // Utiliser l'injection de dépendance pour obtenir les secteurs et les modules
        $sectors = $sectorController->index();

        $user = Auth::user();

        // Retourner la vue index avec les secteurs et les modules récupérés
        return view('admin.Pages.sector.index', compact('sectors','user'));
    }

    public function deleteSector($id, SectorController $sectorController)
    {

        // Appelez la méthode de suppression du SectorController
        return $sectorController->delete($id);
    }

    public function editSector($id, SectorController $sectorController)
    {
        // Appel de la méthode edit du SectorController
        return $sectorController->edit($id);
    }
    public function updateSector(Request $request, $id, SectorController $sectorController)
    {
        // Appeler la méthode update du SectorController
        return $sectorController->update($request, $id);
    }

    public function addSector(SectorController $sectorController)
    {
        return $sectorController->add();
    }
    public function storeSector(Request $request, SectorController $sectorController)
    {
        return $sectorController->store($request);
    }
    public function addModule($id)
    {
        $user = Auth::user();

        // Récupérer le semestre en fonction de l'ID
        $semester = Semester::findOrFail($id);

        // Passer le semestre à la vue pour l'ajout de module
        return view('admin.Pages.sector.addModule', compact('user','semester'));
    }

    public function storeModule(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        // Créer un nouveau module avec les données validées
        $module = new Module();
        $module->name = $validatedData['name'];
        $module->semester_id = $id; // Associez le module au semestre en utilisant l'ID du semestre

        // Gestion du téléchargement de la photo
        if ($request->hasFile('photo')) {
            $photoPath='/storage/';
            $photoPath .= $request->file('photo')->store('modules_photos');
            $module->photo = $photoPath;

        } else {

            $module->photo = '/storage/modules_photos/book.png';
        }

        // Enregistrer le nouveau module dans la base de données
        $module->save();

       // dd($module);
        // Rediriger vers la route nommée 'modules' avec l'identifiant du secteur après l'ajout d'un module
        // Récupérer l'identifiant du secteur associé à ce semestre
        $semester = Semester::findOrFail($id);
        $sectorId = $semester->sector_id;

        // Rediriger vers la route nommée 'modules' avec l'identifiant du secteur après l'ajout d'un module
        return redirect()->route('modules', $sectorId)->with('success', 'Le module a été ajouté avec succès au semestre.');


    }



    public function showModules($id, SectorController $sectorController): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return $sectorController->showModules($id);
    }
    // Méthode pour supprimer un module
    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);
        $semesterId = $module->semester_id; // Obtenez l'ID du semestre avant la suppression
        $module->delete();

        return redirect()->back()->with('success', 'Le module a été supprimer.');
    }

    // Méthode pour afficher la vue de modification d'un module
    public function editModule($id)
    {
        $user = Auth::user();

        $module = Module::findOrFail($id);
        return view('admin.Pages.sector.editModule', compact('user','module'));
    }

     /*-------------------------------------------- Teacher-------------------------------------------------------------*/
     public function teachers()
{
    // Récupérez les enseignants
    $teachers = Teacher::all();
    
    // Récupérez les départements
    $departements = Department::all();

    // Passez les variables à la vue
    return view('admin.Pages.teachers', compact('teachers', 'departements'));
}
public function assignDepartment(Request $request, $teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $teacher->department_id = $request->input('department_id');
        $teacher->save();

        return redirect()->back()->with('success', 'Le département a été assigné avec succès.');
    }



    // Méthode pour mettre à jour un module
    public function updateModule(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string',
            ]);

        // Récupérer l'identifiant du secteur associé à ce module
        $module = Module::findOrFail($id);
        $semesterId = $module->semester_id;
        $semester = Semester::findOrFail($semesterId);
        $sectorId = $semester->sector_id;

        // Mettre à jour les données du module avec les données validées
        $module->name = $validatedData['name'];

        // Gestion du téléchargement de la photo
        if ($request->hasFile('photo')) {
            $photoPath = '/storage/';
            $photoPath .= $request->file('photo')->store('modules_photos');
            $module->photo = $photoPath;

        }

        // Enregistrer les modifications du module dans la base de données
        $module->save();

        // Rediriger vers la route nommée 'modules' avec l'identifiant du secteur après la mise à jour du module
        return redirect()->route('modules', $sectorId)->with('success', 'Le module a été modifié avec succès.');
    }


}

