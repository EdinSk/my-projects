<div class="container mx-auto p-6">
    <!-- Search and Title -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Blogs List</h1>

        <!-- Search Bar -->
        <input wire:model.live="search" placeholder="Search Blogs by Title or Author..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    

    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="mb-4 text-green-600">
        {{ session('message') }}
    </div>
    @endif

    <!-- Blogs Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    @php
                    $headers = [
                    'Title' => 'title',
                    'Author' => 'author_id',
                    'Created At' => 'created_at',
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
                @forelse($blogs as $blog)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $blog->title }}</td>
                    <td class="px-4 py-2">
                        {{ $blog->author->first_name ?? 'No Author' }} {{ $blog->author->last_name ?? '' }}
                    </td>
                    <td class="px-4 py-2">{{ $blog->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-2">
                        <button
                            wire:click="selectBlogForEdit({{ $blog->id }})"
                            class="text-blue-500 hover:text-blue-700 mr-2">
                            Edit
                        </button>
                        <button
                            wire:click="deleteBlog({{ $blog->id }})"
                            onclick="confirm('Are you sure you want to delete this blog?') || event.stopImmediatePropagation()"
                            class="text-red-500 hover:text-red-700">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No blogs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $blogs->links() }}
    </div>

    <!-- Inline Edit Form -->
    @if ($selectedBlogId)
        <div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-2xl mb-4">Edit Blog</h2>

            <!-- Include your external form here -->
            @livewire('admin.blogs.edit-blog', ['blogId' => $selectedBlogId])
            </div>
    @endif
</div>