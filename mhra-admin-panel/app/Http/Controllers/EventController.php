<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $limit = 6; // Number of events to display initially
        $events = Event::orderBy('start_date', 'asc')->take($limit)->get();
        $totalEvents = Event::count(); // Get the total number of events

        return view('events.index', compact('events', 'totalEvents', 'limit'));
    }

    public function create()
    {
        // Return the event creation form view
        return view('events.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'required|string|max:255',  // You might replace this with an image upload logic
        ]);

        // Create a new event in the database
        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show($id)
    {
        // Fetch the event from the database
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        // Fetch the event to edit from the database
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'required|string|max:255',  // Again, this can be an image upload field
        ]);

        // Fetch the event and update it
        $event = Event::findOrFail($id);
        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        // Find the event and delete it
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
