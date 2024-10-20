<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role', 'staff')->get();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

     public function edit(User $member)
    {
        return view('staff.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',

        ]);

        $member->update($request->all());
        return redirect()->route('staff.index')->with('success', 'staff updated successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'staff', // Setting the role as 'staff'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff member added successfully.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
