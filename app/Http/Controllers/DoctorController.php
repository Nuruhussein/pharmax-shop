<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // Fetch all users with the 'doctor' role
        $doctors = User::where('role', 'doctor')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        // Show the form to create a new 'doctor' user
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user with the 'doctor' role
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'doctor',
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function edit($id)
    {
        // Find the doctor by ID
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        // Return the edit view with the doctor details
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        // Find the doctor by ID
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        // Update the doctor's details
        $doctor->update($request->only('name', 'email'));

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(User $doctor)
    {
        // Delete the specified 'doctor' user
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
