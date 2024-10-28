<?php

namespace App\Livewire;

use App\Models\Badge; // Use the Badge model
use Livewire\Component;

class EventBadges extends Component
{
    public $badges; // Property to hold the fetched badges

    public function mount()
    {
        // Fetch all badges from the database
        $this->badges = Badge::all();
    }

    public function render()
    {
        // Pass the badges to the view
        return view('livewire.partials.event-badges', ['badges' => $this->badges]);
    }
}

