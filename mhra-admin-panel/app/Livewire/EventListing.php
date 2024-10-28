<?php
namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventListing extends Component
{
    public $hrCoffeeEvents;
    public $hrWeekendEvents;
    public $hrWebinarEvents;
    public $hrConferenceEvents;

    public $initialCount = 4;  // Number of events to show initially for each type
    public $hrCoffeeVisibleCount = 4;
    public $hrWeekendVisibleCount = 4;
    public $hrWebinarVisibleCount = 4;
    public $hrConferenceVisibleCount = 4;

    public function mount()
    {
        // Fetch only the necessary events for each type
        $this->hrCoffeeEvents = Event::where('event_type', Event::TYPE_HR_COFFEE)->take($this->hrCoffeeVisibleCount)->get();
        $this->hrWeekendEvents = Event::where('event_type', Event::TYPE_HR_WEEKEND)->take($this->hrWeekendVisibleCount)->get();
        $this->hrWebinarEvents = Event::where('event_type', Event::TYPE_HR_WEBINAR)->take($this->hrWebinarVisibleCount)->get();
        $this->hrConferenceEvents = Event::where('event_type', Event::TYPE_HR_CONFERENCE)->take($this->hrConferenceVisibleCount)->get();
    }

    // Method to load more HR Coffee events
    public function loadMoreCoffee()
    {
        $this->hrCoffeeVisibleCount += $this->initialCount;
        // Re-query the database to fetch more events
        $this->hrCoffeeEvents = Event::where('event_type', Event::TYPE_HR_COFFEE)->take($this->hrCoffeeVisibleCount)->get();
    }

    // Method to load more HR Weekend events
    public function loadMoreWeekend()
    {
        $this->hrWeekendVisibleCount += $this->initialCount;
        $this->hrWeekendEvents = Event::where('event_type', Event::TYPE_HR_WEEKEND)->take($this->hrWeekendVisibleCount)->get();
    }

    // Method to load more HR Webinar events
    public function loadMoreWebinar()
    {
        $this->hrWebinarVisibleCount += $this->initialCount;
        $this->hrWebinarEvents = Event::where('event_type', Event::TYPE_HR_WEBINAR)->take($this->hrWebinarVisibleCount)->get();
    }

    // Method to load more HR Conference events
    public function loadMoreConference()
    {
        $this->hrConferenceVisibleCount += $this->initialCount;
        $this->hrConferenceEvents = Event::where('event_type', Event::TYPE_HR_CONFERENCE)->take($this->hrConferenceVisibleCount)->get();
    }

    public function render()
    {
        return view('livewire.partials.event-listing', [
            'hrCoffeeEvents' => $this->hrCoffeeEvents,
            'hrWeekendEvents' => $this->hrWeekendEvents,
            'hrWebinarEvents' => $this->hrWebinarEvents,
            'hrConferenceEvents' => $this->hrConferenceEvents,
        ]);
    }
}
