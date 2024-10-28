<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        return view('form.join');
    }

    public function store(Request $request)
    {
        // Logic to handle the "join" action

        return redirect()->route('form.join')->with('success', 'You have successfully joined.');
    }
}
