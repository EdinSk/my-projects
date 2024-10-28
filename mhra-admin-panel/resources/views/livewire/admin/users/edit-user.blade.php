<div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
    <h2 class="text-2xl mb-4">Edit User</h2>

    <!-- Form -->
    <form wire:submit.prevent="updateUser">
        <!-- First Name -->
        <div class="mb-4">
            <label class="block text-gray-700">First Name</label>
            <input type="text" wire:model.defer="first_name" class="w-full px-3 py-2 border rounded" placeholder="Enter first name" />
            @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label class="block text-gray-700">Last Name</label>
            <input type="text" wire:model.defer="last_name" class="w-full px-3 py-2 border rounded" placeholder="Enter last name" />
            @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" wire:model.defer="email" class="w-full px-3 py-2 border rounded" placeholder="Enter email" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block text-gray-700">Role</label>
            <input type="text" wire:model.defer="role" class="w-full px-3 py-2 border rounded" placeholder="Enter role" />
            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- City -->
        <div class="mb-4">
            <label class="block text-gray-700">City</label>
            <input type="text" wire:model.defer="city" class="w-full px-3 py-2 border rounded" placeholder="Enter city" />
            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Country -->
        <div class="mb-4">
            <label class="block text-gray-700">Country</label>
            <input type="text" wire:model.defer="country" class="w-full px-3 py-2 border rounded" placeholder="Enter country" />
            @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="button" wire:click="cancelEdit" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                Save
            </button>
        </div>
    </form>
</div>
