<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class UserSettings extends Component
{

    use WithFileUploads;  // Add this to enable file uploads

    public $first_name, $last_name, $email, $password, $title;
    public $phone, $city, $country, $bio, $cv_url;
    public $photo; // To handle image upload
    public $showEditModal = false;

    public function mount()
    {
        // Load user data
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->title = $user->title;
        $this->phone = $user->phone;
        $this->city = $user->city;
        $this->country = $user->country;
        $this->bio = $user->bio;
        $this->cv_url = $user->cv_url;
    }

    public function saveSettings()
    {
        $user = Auth::user();
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'cv_url' => 'nullable|url',
            'photo' => 'nullable|image|max:1024',  // Validate image upload (max 1MB)

        ]);

        // Update user data
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->title = $this->title;
        $user->phone = $this->phone;
        $user->city = $this->city;
        $user->country = $this->country;
        $user->bio = $this->bio;
        $user->cv_url = $this->cv_url;

        if ($this->photo) {
            $photoPath = $this->photo->store('images/users', 'public');
            $user->photo_url = $photoPath;
        }

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Hide the modal by setting showEditModal to false
        $this->showEditModal = false;

        session()->flash('message', 'Settings saved successfully.');
    }



    public function render()
    {
        return view('livewire.partials.user-settings');
    }
}
