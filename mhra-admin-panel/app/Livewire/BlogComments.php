<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogComment;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\CommentLike;

class BlogComments extends Component
{
    public $blog;
    public $comments = [];
    public $newComment = '';
    public $newReply = '';
    public $replyTo = null;

    public function mount($blog)
    {
        $this->blog = $blog;
        $this->loadComments(); // Load comments on mount
    }

    public function loadComments()
    {
        // Load all top-level comments (those without a parent comment)
        $this->comments = BlogComment::where('blog_id', $this->blog->id)
            ->whereNull('parent_comment_id') // Only top-level comments
            ->with('replies', 'user') // Load replies and user data
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function deleteComment($commentId)
    {
        $comment = BlogComment::findOrFail($commentId);

        // Ensure the authenticated user is the author of the comment
        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            $this->loadComments(); // Refresh the comment list after deletion
        }
    }

    public function addComment()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validate the new comment
        $this->validate(['newComment' => 'required|min:3']);

        // Create the new comment
        BlogComment::create([
            'blog_id' => $this->blog->id,
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);

        // Clear the input and reload the comments
        $this->newComment = '';
        $this->loadComments();
    }

    public function toggleLike($commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $comment = BlogComment::findOrFail($commentId);

        if ($comment->isLikedByUser(Auth::id())) {
            // Unlike the comment
            CommentLike::where('comment_id', $commentId)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            // Like the comment
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id' => Auth::id(),
            ]);
        }

        $this->loadComments(); // Refresh the comment list
    }

    public function addReply($commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validate the reply
        $this->validate(['newReply' => 'required|min:3']);

        // Create the reply, referencing the parent comment
        BlogComment::create([
            'blog_id' => $this->blog->id,
            'user_id' => Auth::id(),
            'content' => $this->newReply,
            'parent_comment_id' => $commentId, // Link to the parent comment
        ]);

        // Clear the reply input and reload the comments
        $this->newReply = '';
        $this->replyTo = null;
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.partials.blog-comments');
    }
}
