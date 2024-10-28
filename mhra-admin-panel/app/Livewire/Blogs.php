<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class Blogs extends Component
{
    public $blogs;    // This will store all the blog data
    public $limit = 8; // How many blogs to display initially

    public function mount()
    {
        // Fetch all blogs from the database
        $this->blogs = Blog::orderBy('created_at', 'desc')->get();
    }

    public function loadMore()
    {
        // Increase the limit by 8 to show more blogs
        $this->limit += 8;
    }

    public function render()
    {
        return view('livewire.partials.blogs', [
            'blogs' => $this->blogs, // Pass all the blogs to the view
            'limit' => $this->limit, // Pass the current limit to the view
        ]);
    }
}
