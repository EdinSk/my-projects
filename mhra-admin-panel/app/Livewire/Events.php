<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Events extends Component
{
    public $limit = 6; // Initial limit of events
    public $totalEvents; // Total number of events

    public function mount()
    {
        // Set the total number of events
        $this->totalEvents = Event::count();
    }
    

    public function loadMore()
    {
        // Increase the limit when "View More" is clicked, but do not exceed the total number of events
        if ($this->limit < $this->totalEvents) {
            $this->limit += 6;
        }
    }

    public function render()
    {
        // Fetch the limited number of events based on the current limit
        $events = Event::orderBy('start_date', 'asc')->take($this->limit)->get();

        return view('livewire.partials.events', ['events' => $events, 'totalEvents' => $this->totalEvents]);
    }
}