<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //
    }

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
