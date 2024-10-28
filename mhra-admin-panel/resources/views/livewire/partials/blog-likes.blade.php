<div class="d-flex align-items-center">
    <!-- Like Button -->
    <button wire:click="toggleLike" class="btn btn-link text-danger text-decoration-none">
        @if ($isLiked)
            <i class="fas fa-heart text-danger"></i>
        @else
            <i class="far fa-heart"></i>
        @endif
        <span>{{ $likesCount }}</span> <!-- Display the number of likes -->
    </button>

    <!-- Number of comments -->
    <span class="ms-4">
        <i class="far fa-comment"></i> {{ $commentsCount }} <!-- Display the number of comments -->
    </span>
</div>

