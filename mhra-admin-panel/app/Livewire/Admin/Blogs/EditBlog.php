<?php

namespace App\Livewire\Admin\Blogs;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogSection;

class EditBlog extends Component
{
    public $blogId;
    public $title, $author_id;
    public $sections = [];

    public function mount($blogId)
    {
        $this->blogId = $blogId;
        $this->loadBlog();
    }

    public function loadBlog()
    {
        // Load blog and its sections
        $blog = Blog::with('sections')->findOrFail($this->blogId);

        $this->title = $blog->title;
        $this->author_id = $blog->author_id;

        // Load blog sections
        $this->sections = $blog->sections->toArray();
    }

    public function updateBlog()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:users,id',
            'sections.*.section_title' => 'required|string',
            'sections.*.section_body' => 'required|string',
        ]);

        // Update the blog
        $blog = Blog::findOrFail($this->blogId);
        $blog->update([
            'title' => $this->title,
            'author_id' => $this->author_id,
        ]);

        // Update each blog section
        foreach ($this->sections as $key => $section) {
            if (isset($section['id'])) {
                $blogSection = BlogSection::find($section['id']);
                if ($blogSection) {
                    $blogSection->update([
                        'section_title' => $section['section_title'],
                        'section_body' => $section['section_body'],
                        'order' => $section['order'],
                    ]);
                }
            } else {
                // Create new section if it doesn't exist
                BlogSection::create([
                    'blog_id' => $this->blogId,
                    'section_title' => $section['section_title'],
                    'section_body' => $section['section_body'],
                    'order' => $section['order'],
                ]);
            }
        }

        session()->flash('message', 'Blog updated successfully.');
    }

    public function addSection()
    {
        $this->sections[] = [
            'section_title' => '',
            'section_body' => '',
            'order' => count($this->sections) + 1,
        ];
    }

    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);  // Re-index the array
    }

    public function render()
    {
        return view('livewire.admin.blogs.edit-blog');
    }
}

