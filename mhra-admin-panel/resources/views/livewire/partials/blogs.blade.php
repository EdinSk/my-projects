<div class="my-3 py-3">
    <!-- Blog Cards Grid -->
    <div class="row g-3"> <!-- Reduced the gap to g-3 for smaller spacing -->
        @foreach ($blogs->take($limit) as $blog) <!-- Limit the number of blogs shown -->
        <div class="col-md-3 col-sm-6 d-flex align-items-stretch"> <!-- Flexbox to make sure cards have the same height -->
            <div class="card blog-card shadow-sm rounded-4 overflow-hidden w-100">
                <img src="https://picsum.photos/300/200?random={{ $loop->index }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 150px; object-fit: cover;"> <!-- Smaller image height -->
                <div class="card-body d-flex flex-column"> <!-- Flexbox to control the content layout -->
                    <h5 class="card-title text-truncate" title="{{ $blog->title }}">{{ $blog->title }}</h5> <!-- Truncate long titles -->
                    <div class="mt-auto"> <!-- Push the button to the bottom -->
                        <a href="{{ route('blogs.show', $blog->id) }}" class="stretched-link text-warning">Прочитај повеќе</a> <!-- Link to single blog page -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Show More Button -->
    @if ($limit < $blogs->count()) <!-- If there are more blogs to show -->
        <div class="text-center mt-4">
            <button wire:click="loadMore" class="btn btn-primary">Покажи повеќе</button>
        </div>
    @endif

    <!-- Custom CSS for Hover and Zoom Effect -->
    <style>
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Smooth transition for zoom and shadow */
        }

        .blog-card:hover {
            transform: scale(1.05);
            /* Slightly enlarge the card on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Add a larger shadow on hover */
        }
    </style>
</div>
