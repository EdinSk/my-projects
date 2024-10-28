<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Recommendation;

class UserRecommendations extends Component
{
    public $recommendations;

    public function mount($recommendations)
    {
        $this->recommendations = $recommendations; // Initialize recommendations

    }

    public function render()
    {
        return view('livewire.partials.user-recommendations');
    }
}
