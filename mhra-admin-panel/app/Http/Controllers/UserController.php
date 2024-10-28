<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show the list of users
    public function index()
    {
        // Logic to fetch users and pass to the view
        return view('users.index');
    }

    // Show the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validation and storage logic here

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show a specific user
    public function show($id)
    {
        // Logic to fetch the specific user
        return view('users.show', compact('user'));
    }

    // Show the form to edit a user
    public function edit($id)
    {
        // Logic to fetch user to edit
        return view('users.edit', compact('user'));
    }

    // Update a specific user in the database
    public function update(Request $request, $id)
    {
        // Validation and update logic here

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete a specific user
    public function destroy($id)
    {
        // Logic to delete the user

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    
}
