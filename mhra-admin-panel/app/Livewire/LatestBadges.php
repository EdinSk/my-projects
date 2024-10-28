<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LatestBadges extends Component
{
    public $badges;

    public function mount()
    {
        $this->badges = Auth::user()->badges()->latest()->take(3)->get(); // Adjust as needed
    }

    public function render()
    {
        return view('livewire.partials.latest-badges');
    }
}