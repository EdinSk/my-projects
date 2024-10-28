<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class UserProfile extends Component
{
    public $user;

    public function mount()  // Type hinting ensures you're passing a User object
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.partials.user-profile');
    }
}
