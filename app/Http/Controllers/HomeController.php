<?php
// HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Sector;
use App\Models\Student;
use App\Models\Teacher;

use Illuminate\View\View;

class HomeController extends Controller
{

    public function index(): View
    {
        $nbrSectors = Sector::count();
        $nbrTeachers = Teacher::count();
        $nbrStudents = Student::count();
        
        $LastsSectors = Sector::orderBy('id', 'desc')->take(4)->get();
    
        return view('Home', [
            'sectors' => $LastsSectors,
            'nbrSectors' => $nbrSectors,
            'nbrTeachers' => $nbrTeachers,
            'nbrStudents' => $nbrStudents,
        ]);
    }
    
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Create a new message
        Message::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ]);

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Message envoyé avec succès !');
    }
    
}
