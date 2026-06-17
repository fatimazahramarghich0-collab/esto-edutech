<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Department;
use App\Models\Module;
use App\Models\Semester;

class SectorController extends Controller
{
    public function index()
    {
        // Récupérer les secteurs depuis la base de données
        $sectors = Sector::all();

        // Retourner les secteurs
        return $sectors;
    }

    public function add()
    {
        $departments = Department::all();
        $chefFilOptions = Sector::pluck('ChefFil')->unique()->toArray(); // Récupérer les chefs de filière uniques depuis la table des secteurs

        return view('admin.Pages.sector.add', compact('departments', 'chefFilOptions'));
    }


    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'department_id' => 'required|int', // Assurez-vous que le département existe dans la base de données
            'name' => 'required|string',
            'ChefFil' => 'required|string',
            'description' => 'required|string',
        ]);

        // Log de l'ID récupéré
        Log::info('ID récupéré : ' . $validatedData['department_id']);

        // Créer une nouvelle filière avec les données du formulaire
        $sector = Sector::create([
            'department_id' => $validatedData['department_id'],
            'name' => $validatedData['name'],
            'ChefFil' => $validatedData['ChefFil'],
            'description' => $validatedData['description'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('sector')->with('success', 'Secteur a été créé avec succès');
    }




    public function show(Sector $sector)
    {
        return view('sectors.show', compact('sector'));
    }

    public function edit($sector)
    {
        // Récupérez le secteur à partir de l'ID
        $sector = Sector::findOrFail($sector);

        // Récupérez tous les chefs de filière
        $chefs = Sector::distinct()->pluck('ChefFil');

        // Retournez la vue d'édition avec les données du secteur et les chefs de filière
        return view('admin.Pages.sector.edit', compact('sector', 'chefs'));
    }


    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string',
            'ChefFil' => 'required|string',
            'description' => 'required|string',
        ]);

        // Récupérer la filière à partir de l'ID
        $sector = Sector::findOrFail($id);

        // Mettre à jour les données de la filière avec les nouvelles valeurs
        $sector->update([
            'name' => $request->name,
            'ChefFil' => $request->ChefFil,
            'description' => $request->description,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('sector')->with('success', 'La filière a été mise à jour avec succès.');
    }

    public function delete($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return response()->json(['message' => 'La filière n\'existe pas.'], 404);
        }

        try {
            $sector->delete();
            return response()->json(['message' => 'La filière a été supprimée avec succès.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué.'], 500);
        }
    }


    // Ajoutez cette ligne pour importer le modèle Module


    public function showModules($id)
    {
        $user = Auth::user();
        // Récupérer la filière en fonction de l'ID
        $sector = Sector::findOrFail($id);

        // Récupérer les semestres pour cette filière avec les modules correspondants
        $semesters = $sector->semesters()->with('modules')->get();

        // Retourner la vue module.blade.php avec les semestres et modules récupérés
        return view('admin.Pages.sector.module', compact('sector', 'semesters', 'user'));
    }






}
