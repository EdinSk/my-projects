<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\User;
use App\Models\Company;
use App\Models\Speaker;

class EventsList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'title';
    public $sortDirection = 'asc';
    public $selectedEventId = null;

    // Event properties for editing
    public $title;
    public $organizerable_type;
    public $organizerable_id;
    public $speakers = [];  // To manage speakers
    public $agenda_title;  // To manage agenda
    public $agendaItems = [];  // To manage agenda items
    public $speaker_id;
    public $speaker_order;
    // Modal visibility
    public $isEditing = false;

    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'organizerable_type' => 'required|string',
        'organizerable_id' => 'required|integer',
    ];

    // Reset pagination when search is updated
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Handle sorting logic
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

    // Select an event for editing
    public function selectEventForEdit($eventId)
    {
        $this->selectedEventId = $eventId;
        $this->loadEvent();
        $this->isEditing = true;
    }

    // Load event data for editing
    public function loadEvent()
    {
        $event = Event::with('speakers', 'agenda.agendaItems')->findOrFail($this->selectedEventId);

        $this->title = $event->title;
        $this->organizerable_type = $event->organizerable_type;
        $this->organizerable_id = $event->organizerable_id;

        // Map speakers data correctly
        $this->speakers = $event->speakers->map(function ($speaker) {
            return [
                'speaker_id' => $speaker->id,  // Speaker ID from the speakers table
                'first_name' => $speaker->first_name,  // Speaker's first name
                'last_name' => $speaker->last_name,  // Speaker's last name
                'order' => $speaker->pivot->order,  // Order from the pivot table
            ];
        })->toArray();

        $this->agenda_title = $event->agenda ? $event->agenda->title : '';
        $this->agendaItems = $event->agenda ? $event->agenda->agendaItems->toArray() : [];
    }

    // Update the event and its organizer
    public function updateEvent()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'organizerable_type' => 'required|string',
            'organizerable_id' => 'required|integer',
            'agenda_title' => 'required|string',
        ]);

        $event = Event::findOrFail($this->selectedEventId);
        $event->update([
            'title' => $this->title,
            'organizerable_type' => $this->organizerable_type,
            'organizerable_id' => $this->organizerable_id,
        ]);

        // Update or create agenda
        $agenda = $event->agenda;
        if ($agenda) {
            $agenda->update(['title' => $this->agenda_title]);
        } else {
            $agenda = $event->agenda()->create(['title' => $this->agenda_title]);
        }

        // Handle agenda items
        foreach ($this->agendaItems as $index => $item) {
            if (isset($item['id'])) {
                $agendaItem = $agenda->agendaItems()->find($item['id']);
                if ($agendaItem) {
                    $agendaItem->update($item);
                }
            } else {
                $agenda->agendaItems()->create($item);
            }
        }

        $event->speakers()->detach();  // Detach existing speakers

        foreach ($this->speakers as $speaker) {
            // Find the speaker by first name and last name
            $speakerRecord = Speaker::where('first_name', $speaker['first_name'])
                ->where('last_name', $speaker['last_name'])
                ->first();

            if ($speakerRecord) {
                // Attach the speaker using their ID and order
                $event->speakers()->attach($speakerRecord->id, [
                    'order' => $speaker['order'],
                ]);
            } else {
                // Optionally handle case when the speaker is not found
                session()->flash('error', 'Speaker not found: ' . $speaker['first_name'] . ' ' . $speaker['last_name']);
            }
        }


        session()->flash('message', 'Event updated successfully.');
        $this->isEditing = false;
    }


    public function addSpeaker()
    {
        $this->validate([
            'speaker_id' => 'required|integer',
            'speaker_order' => 'nullable|integer',
        ]);

        $this->speakers[] = [
            'speaker_id' => $this->speaker_id,
            'order' => $this->speaker_order,
        ];

        // Reset the inputs
        $this->speaker_id = '';
        $this->speaker_order = '';
    }

    public function removeSpeaker($index)
    {
        unset($this->speakers[$index]);
        $this->speakers = array_values($this->speakers);  // Re-index the array
    }

    public function addAgendaItem()
    {
        $this->agendaItems[] = [
            'title' => '',
            'description' => '',
        ];
    }

    public function removeAgendaItem($index)
    {
        unset($this->agendaItems[$index]);
        $this->agendaItems = array_values($this->agendaItems);  // Re-index the array
    }


    // Cancel editing
    public function cancelEdit()
    {
        $this->resetEditing();
    }

    // Reset editing properties
    private function resetEditing()
    {
        $this->selectedEventId = null;
        $this->title = '';
        $this->organizerable_type = '';
        $this->organizerable_id = '';
        $this->isEditing = false;
    }

    // Delete an event
    public function deleteEvent($eventId)
    {
        Event::findOrFail($eventId)->delete();
        session()->flash('message', 'Event deleted successfully.');
    }

    public function render()
    {
        $events = Event::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        $users = User::all();
        $companies = Company::all();

        return view('livewire.admin.events.events-list', [
            'events' => $events,
            'users' => $users,
            'companies' => $companies,
        ]);
    }
}
