<?php

namespace App\Livewire\Admin\Users;
use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $userId;
    public $first_name, $last_name, $email, $role, $city, $country;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadUser();
    }

    public function loadUser()
    {
        $user = User::findOrFail($this->userId);

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->city = $user->city;
        $this->country = $user->country;
    }

    public function updateUser()
    {
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role,
            'city' => $this->city,
            'country' => $this->country,
        ]);

        session()->flash('message', 'User updated successfully.');

        // Instead of emit, we use dispatch
        $this->dispatch('userUpdated');
    }

    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
