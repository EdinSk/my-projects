<!-- resources/views/livewire/admin/blogs/edit-blog.blade.php -->

<div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
    <h2 class="text-2xl mb-4">Edit Blog</h2>

    <!-- Form -->
    <form wire:submit.prevent="updateBlog">
        <!-- Blog Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Blog Title</label>
            <input
                type="text"
                id="title"
                wire:model.defer="title"
                class="w-full px-3 py-2 border rounded"
                placeholder="Enter blog title"
            />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Blog Author -->
        <div class="mb-4">
            <label for="author_id" class="block text-gray-700">Author</label>
            <select
                id="author_id"
                wire:model.defer="author_id"
                class="w-full px-3 py-2 border rounded"
            >
                <option value="">Select Author</option>
                @foreach(\App\Models\User::all() as $author)
                    <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                @endforeach
            </select>
            @error('author_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Blog Sections -->
        <div class="mb-4">
            <h3 class="text-xl mb-2">Sections</h3>
            @foreach($sections as $index => $section)
                <div class="border p-4 mb-4 rounded-lg relative">
                    <!-- Section Title -->
                    <div class="mb-2">
                        <label for="sections.{{ $index }}.section_title" class="block text-gray-700">Section Title</label>
                        <input
                            type="text"
                            id="sections.{{ $index }}.section_title"
                            wire:model.defer="sections.{{ $index }}.section_title"
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Enter section title"
                        />
                        @error('sections.' . $index . '.section_title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Section Body -->
                    <div class="mb-2">
                        <label for="sections.{{ $index }}.section_body" class="block text-gray-700">Section Body</label>
                        <textarea
                            id="sections.{{ $index }}.section_body"
                            wire:model.defer="sections.{{ $index }}.section_body"
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Enter section body"
                        ></textarea>
                        @error('sections.' . $index . '.section_body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remove Section Button -->
                    <button
                        type="button"
                        wire:click="removeSection({{ $index }})"
                        class="absolute top-2 right-2 text-red-500 hover:text-red-700"
                        onclick="confirm('Are you sure you want to remove this section?') || event.stopImmediatePropagation()"
                    >
                        &#10005;
                    </button>
                </div>
            @endforeach

            <!-- Add Section Button -->
            <button
                type="button"
                wire:click="addSection"
                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
            >
                Add Section
            </button>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
            >
                Save Changes
            </button>
        </div>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
