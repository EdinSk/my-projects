<?php

namespace App\Http\Controllers;

use App\Models\Event; // Assuming conferences are stored in the Event model
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index()
    {
        // Fetch all conferences (where is_conference = 1)
        $conferences = Event::where('is_conference', 1)->get();
        return view('conferences.index', compact('conferences'));
    }

    public function create()
    {
        // Return the form to create a new conference
        return view('conferences.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new conference
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker_name' => 'required|string|max:255',
            // Add other fields as necessary
        ]);

        // Add 'is_conference' = 1 when creating a conference
        $validated['is_conference'] = 1;

        // Store the conference
        Event::create($validated);

        return redirect()->route('conferences.index')->with('success', 'Conference created successfully.');
    }

    public function show($id)
    {
        // Fetch a specific conference by ID
        $conference = Event::where('is_conference', 1)->findOrFail($id);
        return view('conferences.show', compact('conference'));
    }

    public function showConference() {
        // Fetch the conference from the database (where is_conference = 1)
        $conference = Event::where('is_conference', 1)->first(); // Assuming you have a flag is_conference
    
        // Pass the conference data to the view
        return view('conference', compact('conference'));
    }

    public function edit($id)
    {
        // Fetch the specific conference to edit by ID
        $conference = Event::where('is_conference', 1)->findOrFail($id);
        return view('conferences.edit', compact('conference'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the conference
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker_name' => 'required|string|max:255',
            // Add other fields as necessary
        ]);

        // Fetch the conference
        $conference = Event::where('is_conference', 1)->findOrFail($id);

        // Update the conference details
        $conference->update($validated);

        return redirect()->route('conferences.index')->with('success', 'Conference updated successfully.');
    }

    public function destroy($id)
    {
        // Fetch the specific conference and delete it
        $conference = Event::where('is_conference', 1)->findOrFail($id);
        $conference->delete();

        return redirect()->route('conferences.index')->with('success', 'Conference deleted successfully.');
    }
}

