<?php

namespace App\Http\Controllers;

use App\Models\ModuleGrade;
use Illuminate\Http\Request;

class ModuleGradeController extends Controller
{
    public function index()
    {
        $moduleGrades = ModuleGrade::all();
        return view('module_grades.index', compact('moduleGrades'));
    }

    public function create()
    {
        return view('module_grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            
        ]);

        ModuleGrade::create($request->all());

        return redirect()->route('module_grades.index')->with('success', 'Module grade created successfully.');
    }

    public function edit(ModuleGrade $moduleGrade)
    {
        return view('module_grades.edit', compact('moduleGrade'));
    }

    public function update(Request $request, ModuleGrade $moduleGrade)
    {
        $request->validate([
            
        ]);

        $moduleGrade->update($request->all());

        return redirect()->route('module_grades.index')->with('success', 'Module grade updated successfully.');
    }

    public function destroy(ModuleGrade $moduleGrade)
    {
        $moduleGrade->delete();

        return redirect()->route('module_grades.index')->with('success', 'Module grade deleted successfully.');
    }

    public function show(ModuleGrade $moduleGrade)
    {
        return view('moduleGrades.show', compact('moduleGrade'));
    }
}
