<div class="container mx-auto p-6">
    <!-- Search and Title -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Users List</h1>

        <!-- Search Bar -->
        <input wire:model.live="search" placeholder="Search Users..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    @php
                        // Define the table headers with corresponding fields
                        $headers = [
                            'Name' => 'first_name',
                            'Email' => 'email',
                            'Role' => 'role',
                            'City' => 'city',
                            'Country' => 'country',  // Add Country header here
                            'Actions' => null
                        ];
                    @endphp

                    @foreach ($headers as $label => $field)
                        <th class="px-4 py-2">
                            @if ($field)
                                <button
                                    type="button"
                                    class="flex items-center w-full cursor-pointer focus:outline-none"
                                    wire:click="sort('{{ $field }}')">
                                    {{ $label }}
                                    @if ($sortBy === $field)
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                🔼
                                            @else
                                                🔽
                                            @endif
                                        </span>
                                    @endif
                                </button>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-2">{{ $user->city }}</td>
                        <td class="px-4 py-2">{{ $user->country }}</td>  <!-- Add Country data here -->
                        <td class="px-4 py-2">
                            <button
                                wire:click="selectUserForEdit({{ $user->id }})"
                                class="text-blue-500 hover:text-blue-700 mr-2">
                                Edit
                            </button>
                            <button
                                wire:click="deleteUser({{ $user->id }})"
                                onclick="confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation()"
                                class="text-red-500 hover:text-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No users found.</td> <!-- Update colspan to 6 to include country -->
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Inline Edit Form -->
    @if ($selectedUserId)
        <div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-2xl mb-4">Edit User</h2>

            <!-- Include your external form here -->
            @livewire('admin.users.edit-user', ['userId' => $selectedUserId])
        </div>
    @endif
</div>
