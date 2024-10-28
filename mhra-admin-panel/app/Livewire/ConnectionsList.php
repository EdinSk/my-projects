<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConnectionsList extends Component
{
    public $connections;

    public function mount()
    {
        $this->connections = Auth::user()->allConnections();
    }

    public function render()
    {
        return view('livewire.partials.connections-list');
    }

}