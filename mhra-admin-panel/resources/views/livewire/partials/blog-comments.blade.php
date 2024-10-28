<div class="container col-9">
    <!-- New Comment Form -->
    @if (Auth::check())
    <div class="mb-4">
        <textarea wire:model="newComment" class="form-control" placeholder="Остави коментар..."></textarea>
        <button wire:click="addComment" class="btn btn-primary mt-2">
            <i class="fas fa-paper-plane"></i> Објави коментар
        </button>
        @error('newComment') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    @else
    <p>Мора да сте најавени за да оставите коментар. <a href="{{ route('login') }}">Најави се</a></p>
    @endif

    <hr>

    <!-- Comments and Replies Section -->
    <div class="comments-section">
        @foreach ($comments as $comment)
        <div class="d-flex mb-4 p-3 rounded bg-light shadow-sm">
            <!-- User Avatar -->
            <div class="flex-shrink-0">
                <img src="https://picsum.photos/400" alt="{{ $comment->user->first_name }}" class="rounded-circle me-3 border border-secondary" width="50" height="50" style="object-fit: cover;">
            </div>

            <!-- Comment Content -->
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-1">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</h6>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-2">{{ $comment->content }}</p>

                <!-- Like, Reply, and Delete Buttons -->
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Like Button -->
                    <button wire:click="toggleLike({{ $comment->id }})" class="btn btn-sm btn-outline-primary me-2">
                        @if ($comment->isLikedByUser(Auth::id()))
                        <i class="fas fa-thumbs-up"></i> <!-- Filled thumbs up when liked -->
                        @else
                        <i class="far fa-thumbs-up"></i> <!-- Empty thumbs up when not liked -->
                        @endif
                        {{ $comment->likes->count() }} <!-- Show number of likes -->
                    </button>

                    <div>
                        <!-- Reply Button and Replies Count -->
                        <button wire:click="$set('replyTo', {{ $comment->id }})" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-reply"></i> Одговори ({{ $comment->replies->count() }}) <!-- Reply Icon and Replies Count -->
                        </button>

                        <!-- Delete Button (Only for the author) -->
                        @if ($comment->user_id === Auth::id())
                        <button wire:click="deleteComment({{ $comment->id }})" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i> Избриши
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Reply Form -->
                @if ($replyTo === $comment->id)
                <div class="mt-3">
                    <textarea wire:model="newReply" class="form-control mb-2" placeholder="Одговори на {{ $comment->user->first_name }}"></textarea>
                    <button wire:click="addReply({{ $comment->id }})" class="btn btn-sm btn-primary">
                        <i class="fas fa-paper-plane"></i> Објави Одговор
                    </button>
                    @error('newReply') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif

                <!-- Replies -->
                <div class="replies-section mt-3 ms-4">
                    @foreach ($comment->replies as $reply)
                    <div class="d-flex mb-3 p-2 rounded bg-white shadow-sm">
                        <!-- Reply Avatar -->
                        <div class="flex-shrink-0">
                            <img src="https://picsum.photos/400" alt="{{ $reply->user->first_name }}" class="rounded-circle me-3 border border-secondary" width="40" height="40" style="object-fit: cover;">
                        </div>
                        <!-- Reply Content -->
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-1">{{ $reply->user->first_name }} {{ $reply->user->last_name }}</h6>
                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{{ $reply->content }}</p>

                            <!-- Delete Button for Replies (Only for the author) -->
                            @if ($reply->user_id === Auth::id())
                            <button wire:click="deleteComment({{ $reply->id }})" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Избриши
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>