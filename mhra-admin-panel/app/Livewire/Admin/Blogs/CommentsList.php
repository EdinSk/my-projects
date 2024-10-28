<?php

namespace App\Livewire\Admin\Blogs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogComment;
use App\Models\User;
use App\Models\Blog;

class CommentsList extends Component
{
    use WithPagination;

    // Search and Sorting
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    // Editing State
    public $isEditing = false;
    public $selectedCommentId = null;
    public $blog_id;
    public $user_id;
    public $parent_comment_id;
    public $content;

    // Data Collections
    public $users = [];
    public $blogs = [];
    public $parentComments = [];

    protected $paginationTheme = 'tailwind'; // Adjust based on your CSS framework

    // Validation Rules
    protected $rules = [
        'blog_id' => 'required|exists:blogs,id',
        'user_id' => 'required|exists:users,id',
        'parent_comment_id' => 'nullable|exists:blog_comments,id',
        'content' => 'required|string',
    ];

    /**
     * Initialize component by loading users, blogs, and parent comments.
     */
    public function mount()
    {
        $this->users = User::all();
        $this->blogs = Blog::all();
        $this->parentComments = BlogComment::all();
    }

    /**
     * Reset pagination when the search term updates.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Handle sorting logic.
     *
     * @param string $field
     */
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = ($this->sortDirection === 'asc') ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    /**
     * Select a comment for editing.
     *
     * @param int $commentId
     */
    public function selectCommentForEdit($commentId)
    {
        $comment = BlogComment::findOrFail($commentId);
        $this->selectedCommentId = $comment->id;
        $this->blog_id = $comment->blog_id;
        $this->user_id = $comment->user_id;
        $this->parent_comment_id = $comment->parent_comment_id;
        $this->content = $comment->content;
        $this->isEditing = true;
    }

    /**
     * Update the selected comment.
     */
    public function updateComment()
    {
        $this->validate();

        $comment = BlogComment::findOrFail($this->selectedCommentId);
        $comment->update([
            'blog_id' => $this->blog_id,
            'user_id' => $this->user_id,
            'parent_comment_id' => $this->parent_comment_id,
            'content' => $this->content,
        ]);

        session()->flash('message', 'Comment updated successfully.');
        $this->isEditing = false;
        $this->resetEditFields();
    }

    /**
     * Delete a comment.
     *
     * @param int $commentId
     */
    public function deleteComment($commentId)
    {
        $comment = BlogComment::findOrFail($commentId);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully.');
    }

    /**
     * Reset editing fields.
     */
    private function resetEditFields()
    {
        $this->selectedCommentId = null;
        $this->blog_id = '';
        $this->user_id = '';
        $this->parent_comment_id = '';
        $this->content = '';
    }

    /**
     * Cancel the editing process.
     */
    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->resetEditFields();
    }

    /**
     * Render the Blade view with paginated comments.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $comments = BlogComment::with(['blog', 'user', 'parentComment'])
            ->where(function ($query) {
                $query->where('content', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($q) {
                          $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('blog', function ($q) {
                          $q->where('title', 'like', '%' . $this->search . '%');
                      });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.blogs.comments-list', [
            'comments' => $comments,
        ]);
    }
}
