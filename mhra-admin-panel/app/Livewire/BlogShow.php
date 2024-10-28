<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\BlogSection;
use Livewire\Component;

class BlogShow extends Component
{
    public $blog;
    public $sections;

    // Mount method runs when the component is instantiated
    public function mount($blogId)
    {
        // Fetch the blog and its sections
        $this->blog = Blog::with('author')->findOrFail($blogId);
        $this->sections = BlogSection::where('blog_id', $blogId)->orderBy('order')->get();
    }

    // Render the Blade view
    public function render()
    {
        return view('livewire.partials.blog-show');
    }
}
