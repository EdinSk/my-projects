<div>
    @if (session()->has('message'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="updateConference">
        <!-- Conference Details -->

        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input
                type="text"
                wire:model.defer="title"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter conference title" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Theme</label>
            <input
                type="text"
                wire:model.defer="theme"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter conference theme" />
            @error('theme') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea
                wire:model.defer="description"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter conference description"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Objective</label>
            <textarea
                wire:model.defer="objective"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter conference objective"></textarea>
            @error('objective') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Location</label>
            <input
                type="text"
                wire:model.defer="location"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter conference location" />
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Start Date</label>
            <input
                type="date"
                wire:model.defer="start_date"
                class="w-full px-3 py-2 border rounded" />
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">End Date</label>
            <input
                type="date"
                wire:model.defer="end_date"
                class="w-full px-3 py-2 border rounded" />
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select wire:model.defer="status" class="w-full px-3 py-2 border rounded">
                <option value="">Select Status</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Hero Image URL</label>
            <input
                type="url"
                wire:model.defer="hero_image_url"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter hero image URL" />
            @error('hero_image_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Agenda Management -->
        <div class="mb-4">
            <h3 class="text-xl mb-2">Agenda</h3>

                <div class="mb-2">
                    <label class="block text-gray-700">Agenda Title</label>
                    <input
                        type="text"
                        wire:model.defer="agendaTitle"
                        class="w-full px-3 py-2 border rounded"
                        placeholder="Enter agenda title" />
                    @error('agendaTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700">Agenda Description</label>
                    <textarea
                        wire:model.defer="agendaDescription"
                        class="w-full px-3 py-2 border rounded"
                        placeholder="Enter agenda description"></textarea>
                    @error('agendaDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


            <button type="button" wire:click="addAgenda" class="text-blue-500 mt-2">Add Agenda</button>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded">
                Save Changes
            </button>
        </div>
    </form>
</div>