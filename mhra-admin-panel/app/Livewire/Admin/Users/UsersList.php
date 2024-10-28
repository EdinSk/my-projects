<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'first_name';
    public $sortDirection = 'asc';
    public $selectedUserId = null;

    protected $listeners = ['userUpdated' => 'render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function selectUserForEdit($userId)
    {
        $this->selectedUserId = $userId;
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        // Fetch users with the search query and sorting applied
        $users = User::query()
            ->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('role', 'like', '%' . $this->search . '%')
                    ->orWhere('city', 'like', '%' . $this->search . '%')
                    ->orWhere('country', 'like', '%' . $this->search . '%');
            })
            // Apply sorting based on selected column and direction
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.users.users-list', [
            'users' => $users,
        ]);
    }
}
