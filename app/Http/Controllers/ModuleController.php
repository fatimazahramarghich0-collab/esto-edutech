<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Module;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        // Retourner la vue d'édition avec les données du module
        return view('admin.Pages.sector.editModule', compact('module'));
    }

    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string',
        ]);

        // Récupérer le module à partir de l'ID
        $module = Module::findOrFail($id);

        // Mettre à jour les données du module avec les nouvelles valeurs
        $module->update([
            'name' => $request->name,
            // Autres champs à mettre à jour si nécessaire
        ]);
        $this->showModules($module->semester_id);

        // Rediriger avec un message de succès
        return $this->showModules($module->semester_id)->with('success', 'Le module a été mis à jour avec succès.');
    }


    public function delete($id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json(['message' => 'Le module n\'existe pas.'], 404);
        }

        try {
            $module->delete();
            return response()->json(['message' => 'Le module a été supprimé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué : ' . $e->getMessage()]);
        }
    }



}
