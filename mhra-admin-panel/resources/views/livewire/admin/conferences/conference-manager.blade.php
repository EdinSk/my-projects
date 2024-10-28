<div class="container mx-auto p-6">
    <!-- Search and Title -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Conferences List</h1>

        <!-- Search Bar -->
        <input wire:model.live="search" placeholder="Search Conferences by Title..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="mb-4 text-green-600">
        {{ session('message') }}
    </div>
    @endif

    <!-- Conferences Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="px-4 py-2">
                        <button type="button" wire:click="sort('title')" class="w-full flex items-center">
                            Title
                            @if ($sortBy === 'title')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '🔼' : '🔽' }}</span>
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2">Organizer</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse($conferences as $conference)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $conference->title }}</td>
                    <td class="px-4 py-2">
                        @if ($conference->organizerable_type === 'App\Models\User')
                        {{ $conference->organizerable->first_name }} {{ $conference->organizerable->last_name }}
                        @elseif ($conference->organizerable_type === 'App\Models\Company')
                        {{ $conference->organizerable->name }}
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <button wire:click="loadConference({{ $conference->id }})" class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                        <button wire:click="deleteConference({{ $conference->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No conferences found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $conferences->links() }}
    </div>

    <!-- Edit Conference Form -->
    @if ($isEditing)
    <div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
        <div class="container mx-auto p-6">
            <h2 class="text-2xl mb-4">Edit Conference</h2>

            <form wire:submit.prevent="updateConference">
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title:</label>
                    <input type="text" wire:model="title" id="title" class="w-full px-4 py-2 border rounded-lg">
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Organizer Type -->
                <div class="mb-4">
                    <label for="organizerable_type" class="block text-gray-700">Organizer Type:</label>
                    <select wire:model="organizerable_type" id="organizerable_type" class="w-full px-4 py-2 border rounded-lg">
                        <option value="">Select Organizer Type</option>
                        <option value="App\Models\User">User</option>
                        <option value="App\Models\Company">Company</option>
                    </select>
                    @error('organizerable_type') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Organizer -->
                <div class="mb-4">
                    <label for="organizerable_id" class="block text-gray-700">Select Organizer:</label>
                    <select wire:model="organizerable_id" id="organizerable_id" class="w-full px-4 py-2 border rounded-lg">
                        @if ($organizerable_type === 'App\Models\User')
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                        @elseif ($organizerable_type === 'App\Models\Company')
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('organizerable_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Agenda Title -->
                <div class="mb-4">
                    <label for="agenda_title" class="block text-gray-700">Agenda Title:</label>
                    <input type="text" wire:model="agenda_title" id="agenda_title" class="w-full px-4 py-2 border rounded-lg">
                    @error('agenda_title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Agenda Items -->
                <div class="mb-4">
                    <label class="block text-gray-700">Agenda Items:</label>
                    @foreach($agendaItems as $index => $item)
                    <div class="mb-2">
                        <input type="text" wire:model="agendaItems.{{ $index }}.title" placeholder="Item Title" class="w-full px-4 py-2 border rounded-lg">
                        <textarea wire:model="agendaItems.{{ $index }}.description" placeholder="Item Description" class="w-full px-4 py-2 border rounded-lg"></textarea>
                        <button type="button" wire:click="removeAgendaItem({{ $index }})" class="text-red-500">Remove</button>
                    </div>
                    @endforeach
                    <button type="button" wire:click="addAgendaItem" class="px-4 py-2 bg-green-500 text-white rounded-lg">Add Agenda Item</button>
                </div>

                <!-- Speakers -->
                <div class="mb-4">
                    <label for="speaker_id" class="block text-gray-700">Select Speaker:</label>
                    <select wire:model="speaker_id" id="speaker_id" class="w-full px-4 py-2 border rounded-lg">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                    @error('speaker_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="speaker_order" class="block text-gray-700">Speaker Order:</label>
                    <input type="number" wire:model="speaker_order" id="speaker_order" class="w-full px-4 py-2 border rounded-lg">
                    @error('speaker_order') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- File Upload for Speaker Photo -->
                <div class="mb-4">
                    <label for="speaker_photo" class="block text-gray-700">Speaker Photo:</label>
                    <input type="file" wire:model="speaker_photo" id="speaker_photo" class="w-full px-4 py-2 border rounded-lg">
                    @error('speaker_photo') <span class="text-red-500">{{ $message }}</span> @enderror

                    @if ($speaker_photo)
                    <!-- Preview uploaded photo before submission -->
                    <div class="mt-2">
                        <img src="{{ $speaker_photo->temporaryUrl() }}" alt="Speaker Photo Preview" class="w-32 h-32 rounded-lg">
                    </div>
                    @endif
                </div>


                <button type="button" wire:click="addSpeaker" class="px-4 py-2 bg-green-500 text-white rounded-lg">Add Speaker</button>

                <!-- Display existing speakers -->
                @foreach($speakers as $index => $speaker)
                <div class="flex justify-between items-center">
                    <div>{{ $speaker['first_name'] }} {{ $speaker['last_name'] }} (Order: {{ $speaker['order'] }})</div>
                    <button wire:click="removeSpeaker({{ $index }})" class="text-red-500">Remove</button>
                </div>
                @endforeach

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update Conference</button>
                    <button type="button" wire:click="cancelEdit" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                </div>
            </form>
        </div>

        @endif
    </div>