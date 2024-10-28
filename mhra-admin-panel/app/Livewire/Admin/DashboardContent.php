<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class DashboardContent extends Component
{
    public $content = 'users-list'; // Default content

    protected $listeners = ['switchContent'];

    public function switchContent($component)
    {
        $this->content = $component;
    }
    public function render()
    {
        return view('livewire.admin.dashboard-content');
    }
}
