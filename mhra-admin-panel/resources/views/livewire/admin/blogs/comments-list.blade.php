<!-- resources/views/livewire/admin/blogs/comments-list.blade.php -->

<div class="container mx-auto p-6">
    <h2 class="text-2xl mb-4">Manage Comments</h2>

    <!-- Search Input -->
    <div class="mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search comments..."
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('message') }}
    </div>
    @endif

    <!-- Comments Table -->
    <table class="min-w-full bg-white mb-6">
        <thead>
            <tr>
                <th
                    wire:click="sort('blog_id')"
                    class="cursor-pointer px-4 py-2 border-b">
                    Blog ID
                    @if($sortBy === 'blog_id')
                    @if($sortDirection === 'asc')
                    🔼
                    @else
                    🔽
                    @endif
                    @endif
                </th>
                <th wire:click="sort('user_id')" class="cursor-pointer px-4 py-2 border-b">
                    User Name
                    @if($sortBy === 'user_id')
                    @if($sortDirection === 'asc')
                    🔼
                    @else
                    🔽
                    @endif
                    @endif
                </th>
                <th
                    wire:click="sort('parent_comment_id')"
                    class="cursor-pointer px-4 py-2 border-b">
                    Replied to
                    @if($sortBy === 'parent_comment_id')
                    @if($sortDirection === 'asc')
                    🔼
                    @else
                    🔽
                    @endif
                    @endif
                </th>
                <th
                    wire:click="sort('content')"
                    class="cursor-pointer px-4 py-2 border-b">
                    Content
                    @if($sortBy === 'content')
                    @if($sortDirection === 'asc')
                    🔼
                    @else
                    🔽
                    @endif
                    @endif
                </th>
                <th
                    wire:click="sort('created_at')"
                    class="cursor-pointer px-4 py-2 border-b">
                    Created At
                    @if($sortBy === 'created_at')
                    @if($sortDirection === 'asc')
                    🔼
                    @else
                    🔽
                    @endif
                    @endif
                </th>
                <th
                    wire:click="sort('updated_at')"
                    class="cursor-pointer px-4 py-2 border-b">
                    Updated At
                    @if($sortBy === 'updated_at')
                    @if($sortDirection === 'asc')
                    &uarr;
                    @else
                    &darr;
                    @endif
                    @endif
                </th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border-b">{{ $comment->blog_id }}</td>
                <td class="px-4 py-2 border-b">{{ $comment->user->first_name}} {{ $comment->user->last_name}}</td>
                <td class="px-4 py-2 border-b">{{ $comment->parent_comment_id ?? 'N/A' }}</td>
                <td class="px-4 py-2 border-b">{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</td>
                <td class="px-4 py-2 border-b">{{ $comment->created_at->format('Y-m-d') }}</td>
                <td class="px-4 py-2 border-b">{{ $comment->updated_at->format('Y-m-d') }}</td>
                <td class="px-4 py-2 border-b">
                    <button
                        wire:click="selectCommentForEdit({{ $comment->id }})"
                        class="bg-blue-500 text-white px-3 py-1 rounded mr-2 hover:bg-blue-600">
                        Edit
                    </button>
                    <button
                        wire:click="deleteComment({{ $comment->id }})"
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                        onclick="confirm('Are you sure you want to delete this comment?') || event.stopImmediatePropagation()">
                        Delete
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-2 text-center">No comments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $comments->links() }}
    </div>

    <!-- Edit Comment Form -->
    @if($isEditing)
    <div class="mt-6 p-6 bg-gray-100 rounded-lg shadow-md">
        <h2 class="text-2xl mb-4">Edit Comment</h2>

        <!-- Form -->
        <form wire:submit.prevent="updateComment">
            <!-- Blog ID -->
            <div class="mb-4">
                <label class="block text-gray-700">Blog</label>
                <select
                    wire:model.defer="blog_id"
                    class="w-full px-3 py-2 border rounded">
                    <option value="">Select Blog</option>
                    @foreach($blogs as $blog)
                    <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                    @endforeach
                </select>
                @error('blog_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- User ID -->
            <div class="mb-4">
                <label class="block text-gray-700">User</label>
                <select
                    wire:model.defer="user_id"
                    class="w-full px-3 py-2 border rounded">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <!-- Content -->
            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea
                    wire:model.defer="content"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Enter comment content"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end">
                <button
                    type="button"
                    wire:click="cancelEdit"
                    class="mr-4 px-4 py-2 bg-gray-500 text-white rounded">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded">
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
    @endif
</div>