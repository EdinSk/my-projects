<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PointsProgress extends Component
{

    public $points;

    public function mount()
    {
        $this->points = Auth::user()->acquired_points; // Adjust as per your actual points logic
    }

    public function render()
    {
        return view('livewire.partials.points-progress');
    }
}
