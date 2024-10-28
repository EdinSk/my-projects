<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $email;

    // public function subscribe()
    // {
    //     $this->validate([
    //         'email' => 'required|email',
    //     ]);

    //     // Handle subscription logic here, e.g., save to the database or send an email

    //     session()->flash('message', 'Successfully subscribed!');
    // }

    public function render()
    {
        return view('livewire.layout.footer');
    }
}

