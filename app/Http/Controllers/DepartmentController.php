<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\View;


class DepartmentController extends Controller
{
    public function index()
    {
        return Department::all();
    }

    public function create()
    {
        $teachers = Teacher::where('StatusDep', 'true')->get();
        return View::make('admin.Pages.department.create', compact('teachers'))->render();
    }

    public function store(Request $request)
    {
        $validatedAttributes = $request->validate([
            'name' => 'required|max:100',
            'chefDep' => 'nullable|max:100',
        ]);

        try {
            Department::create($validatedAttributes);
            return redirect()->route('department')->with('success', 'Department created successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create department.']);

        }
    }


    public function edit($id)
    {
        $dep = Department::findOrFail($id);

        $teachers = Teacher::where('StatusDep', 'true')->get();

        return View::make('admin.Pages.department.edit', compact('dep', 'teachers'))->render();

    }

    public function update(Request $request, int $depId)
    {
        $validatedAttributes = $request->validate([
            'name' => 'nullable|max:100',
            'chefDep' => 'nullable|max:100',
        ]);

        $department = Department::findOrFail($depId);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $validatedAttributes['name'];
        }

        if ($request->filled('chefDep')) {
            $data['chefDep'] = $validatedAttributes['chefDep'];
        }

        $department->update($data);

        return redirect()->route('department');
    }

    public function delete(int $depId)
    {
        $department = Department::findOrFail($depId);
        if ($department->delete()) {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function deleteAll()
    {
        Department::query()->delete();

        return 'success';
    }

    public function GetDeletePage()
    {
        return View::make('admin.Pages.department.delete')->render();
    }
   
}
