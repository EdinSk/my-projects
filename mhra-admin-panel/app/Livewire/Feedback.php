<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Feedback extends Component
{
    public $feedback = '';

    public function submit()
    {
        // Handle feedback submission logic
        // e.g., save feedback in the database
        Feedback::create([
            'user_id' => Auth::id(),
            'content' => $this->feedback,
        ]);

        // Clear feedback form after submission
        $this->feedback = '';
    }

    public function render()
    {
        return view('livewire.feedback');
    }
}