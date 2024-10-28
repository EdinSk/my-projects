<?php
namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Conference extends Component
{
    public $conference; // This will hold the conference event

    public function mount($eventId = null)
    {
        // Fetch the specific event by ID if passed and where event_type is 'conference'
        if ($eventId) {
            $this->conference = Event::where('event_type', Event::TYPE_HR_CONFERENCE)->find($eventId);
        } else {
            // If no event ID is passed, fetch the latest event where event_type is 'conference'
            $this->conference = Event::where('event_type', Event::TYPE_HR_CONFERENCE)->latest()->first();
        }

        // Handle the case where no conference is found
        if (!$this->conference) {
            abort(404, 'Conference not found.');
        }
    }

    public function render()
    {
        // Pass the $conference variable to the Blade view
        return view('livewire.partials.conference', ['conference' => $this->conference]);
    }
}
