<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
{
    $credentials = [
        'email' => 'admin@example.com',
        'password' => '123456',
    ];

    if (Auth::attempt($credentials, $this->remember)) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->redirectRoute('admin.dashboard');
        } else {
            return $this->redirectRoute('user.dashboard');
        }
    } else {
        session()->flash('error', 'The provided credentials do not match our records.');
    }
}


    public function render()
    {
        return view('livewire.login');
    }
}
