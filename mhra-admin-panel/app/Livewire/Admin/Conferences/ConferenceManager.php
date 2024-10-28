<?php

namespace App\Livewire\Admin\Conferences;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\User;
use App\Models\Company;
use Livewire\WithFileUploads; // Include this Livewire trait

class ConferenceManager extends Component
{
    use WithPagination;
    use WithFileUploads;  // Add this trait for file uploads

    public $title;
    public $agenda_title;
    public $agendaItems = [];
    public $speakers = [];
    public $speaker_id;
    public $speaker_order;
    public $organizerable_type;
    public $organizerable_id;
    public $selectedEventId;
    public $isEditing = false;
    public $speaker_photo;
    public $search = ''; // To handle search functionality for conferences
    public $sortBy = 'title';  // Sort conferences by title
    public $sortDirection = 'asc';  // Sort direction
    protected $paginationTheme = 'tailwind';

    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'organizerable_type' => 'required|string',
        'organizerable_id' => 'required|integer',
        'agenda_title' => 'required|string',
        'speaker_photo' => 'nullable|image|max:1024',  // Validate the image (1MB max)

    ];

    // Load a conference for editing
    public function loadConference($eventId)
    {
        // Load the conference details
        $conference = Event::with('speakers', 'agenda.agendaItems')
            ->where('id', $eventId)
            ->where('event_type', 'HR_Conference')
            ->firstOrFail();

        // Set properties for editing
        $this->selectedEventId = $conference->id;
        $this->title = $conference->title;
        $this->organizerable_type = $conference->organizerable_type;
        $this->organizerable_id = $conference->organizerable_id;

        $this->speakers = $conference->speakers->map(function ($speaker) {
            return [
                'speaker_id' => $speaker->id,
                'first_name' => $speaker->first_name,
                'last_name' => $speaker->last_name,
                'order' => $speaker->pivot->order,
            ];
        })->toArray();

        $this->agenda_title = $conference->agenda ? $conference->agenda->title : '';
        $this->agendaItems = $conference->agenda ? $conference->agenda->agendaItems->toArray() : [];

        // Set isEditing to true
        $this->isEditing = true;
    }
    public function removeAgendaItem($index)
    {
        // Remove the agenda item at the specified index
        unset($this->agendaItems[$index]);

        // Re-index the array after removal to prevent gaps in array indices
        $this->agendaItems = array_values($this->agendaItems);
    }

    public function addAgendaItem()
    {
        // Add a new empty agenda item to the agendaItems array
        $this->agendaItems[] = [
            'title' => '',
            'description' => '',
        ];
    }

    public function updateConference()
    {
        // Validate the inputs
        $this->validate();

        // Find the conference being updated
        $conference = Event::findOrFail($this->selectedEventId);

        // Ensure it's a conference before proceeding
        if ($conference->event_type !== 'HR_Conference') {
            session()->flash('error', 'This event is not a conference.');
            return;
        }



        $photoPath = null;
        if ($this->speaker_photo) {
            $photoPath = $this->speaker_photo->store('images/conference', 'public');  // Store in public/images/conference
        }

        // Update the conference fields
        $conference->update([
            'title' => $this->title,
            'organizerable_type' => $this->organizerable_type,
            'organizerable_id' => $this->organizerable_id,
            'photo_url' => $photoPath,  // Save the file path to the database
        ]);
        // Update or create agenda
        $agenda = $conference->agenda;
        if ($agenda) {
            $agenda->update(['title' => $this->agenda_title]);
        } else {
            $agenda = $conference->agenda()->create(['title' => $this->agenda_title]);
        }

        // Handle speakers
        $conference->speakers()->detach();
        foreach ($this->speakers as $speaker) {
            $conference->speakers()->attach($speaker['speaker_id'], [
                'order' => $speaker['order'],
            ]);
        }

        session()->flash('message', 'Conference updated successfully.');
        $this->isEditing = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();  // Reset pagination when searching
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function deleteConference($eventId)
    {
        $conference = Event::findOrFail($eventId);

        // Ensure it's a conference before deleting
        if ($conference->event_type === 'HR_Conference') {
            $conference->delete();
            session()->flash('message', 'Conference deleted successfully.');
        }
    }

    public function render()
    {
        // Fetch all conferences with pagination and optional search
        $conferences = Event::where('event_type', 'HR_Conference')
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        $users = User::all();
        $companies = Company::all();

        return view('livewire.admin.conferences.conference-manager', [
            'conferences' => $conferences,
            'users' => $users,
            'companies' => $companies,
        ]);
    }
}
