<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class ConferenceLatest extends Component
{
    public $conference;

    public function mount()
    {
        // Fetch the latest event with the event_type set to 'conference'
        $this->conference = Event::where('event_type', Event::TYPE_HR_CONFERENCE)
                                  ->latest('start_date') // Fetch by the latest start date
                                  ->first();

        // Handle the case where no conference is found
        if (!$this->conference) {
            abort(404, 'No conferences available.');
        }
    }

    public function render()
    {
        return view('livewire.partials.conference-latest', [
            'conference' => $this->conference
        ]);
    }

}
