<div class="w-1/4 bg-gray-800 text-white vh-100">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">MHRA Admin Panel</h2>
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.users') }}" wire:navigate.hover class="block py-2 px-4 bg-gray-700 w-full text-left text-white fw-bold fs-5 text-decoration-none">
                        Users
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.blogs') }}" wire:navigate.hover class="block py-2 px-4 bg-gray-700 w-full text-left text-white fw-bold fs-5 text-decoration-none">
                        Blogs
                    </a>
                </li>
                @if (request()->is('admin/blogs') or request()->is('admin/blogs/comments'))
                <li class="mb-2">
                    <a href="{{ route('comments') }}" wire:navigate.hover class="block col-9 ms-auto py-2 px-4 bg-gray-700 w-full text-left text-white fw-bold fs-6 text-decoration-none">
                        Comments
                    </a>
                </li>
                @endif
                <li class="mb-2">
                    <a href="{{ route('admin.events') }}" wire:navigate.hover class="block py-2 px-4 bg-gray-700 w-full text-left text-white fw-bold fs-5 text-decoration-none">
                        Events
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.conference') }}" wire:navigate.hover class="block py-2 px-4 bg-gray-700 w-full text-left text-white fw-bold fs-5 text-decoration-none">
                        Conferences
                    </a>
                </li>
            </ul>




        </nav>
    </div>
</div>