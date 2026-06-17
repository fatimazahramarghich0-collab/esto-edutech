<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $idAdmin)
    {
        $admin = Admin::find($idAdmin);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:admins,email,' . $admin->id . '|max:255',
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            $imagePath = '/storage/';
            $imagePath .= $request->file('photo')->store('admin_images');

            $data['photo'] = $imagePath;
        }

        $admin->update($data);

        Auth::loginUsingId($admin->id);

        return redirect()->route('profile')->with('success', 'Administrateur a été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Administrateur a été supprimé.');
    }
}
