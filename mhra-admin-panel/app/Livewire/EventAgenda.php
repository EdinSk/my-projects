<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Agenda;

class EventAgenda extends Component
{
    public $eventId;
    public $agenda;
    public $agendaItems;

    // Accept the eventId parameter in the mount method
    public function mount($eventId)
    {
        // Fetch the agenda for the given event ID
        $this->agenda = Agenda::where('event_id', $eventId)->with('items')->first();

        // Fetch agenda items related to this agenda
        if ($this->agenda) {
            $this->agendaItems = $this->agenda->items; // Load related agenda items
        } else {
            $this->agendaItems = collect(); // Empty collection if no agenda exists
        }
    }


    public function render()
    {
        return view('livewire.partials.event-agenda');
    }
}