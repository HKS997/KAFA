<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class ManageRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'Kafa') {
            return view('ManageRegistration.Kafa Admin.dashboard');
        } elseif (auth()->user()->role == 'Muip') {
            return view('ManageRegistration.Muip Admin.dashboard');
        } elseif (auth()->user()->role == 'Parent') {
            return view('ManageRegistration.Parent.dashboard');
        } elseif (auth()->user()->role == 'Teacher') {
            return view('ManageRegistration.Teacher.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the registration form
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:11|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        ]);

        // Create a new user if validation passes
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to the appropriate page with success message
        return redirect()->route('login')->with('status', 'Registration successful! Please login.');
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
