<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();

        // Retourner les semestres
        return $semesters;
    }
    public function showSemesters($sectorId)
    {
        $semesters = Semester::where('sector_id', $sectorId)->get();
        return view('admin.Pages.sector.index', compact('semesters')); // Change ici pour la vue index
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function add($id)
//    {
//        $semester = Semester::findOrFail($id);
//        return view('admin.Pages.semester.addModule', compact('semester'));
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
