<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogLike;
use Illuminate\Support\Facades\Auth;

class BlogLikes extends Component
{
    public $blog;
    public $isLiked;
    public $likesCount;
    public $commentsCount;

    public function mount($blog)
    {
        // Initialize blog data
        $this->blog = $blog;
        $this->isLiked = Auth::check() ? $this->blog->isLikedByUser(Auth::id()) : false;
        $this->likesCount = $this->blog->likes()->count();
        $this->commentsCount = $this->blog->comments()->count();
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isLiked) {
            // Unlike the blog
            BlogLike::where('blog_id', $this->blog->id)
                ->where('user_id', Auth::id())
                ->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            // Like the blog
            BlogLike::create([
                'blog_id' => $this->blog->id,
                'user_id' => Auth::id(),
            ]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.partials.blog-likes');
    }
}