<?php

use App\Http\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth; // Add this import

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $user = Auth::user(); // Get the authenticated user

        if ($user->role === 'admin') {
            $this->redirectRoute('admin.dashboard');
        } else {
            $this->redirectRoute('user.dashboard');
        }
    }
};
