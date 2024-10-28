<?php

namespace App\Livewire\Admin\Blogs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\BlogSection;
use App\Models\User;

class BlogsList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'title';
    public $sortDirection = 'asc';
    public $selectedBlogId = null;

    // Blog properties for editing
    public $title;
    public $author_id;
    public $sections = [];
    public $deletedSections = [];

    // Modal visibility
    public $isEditing = false;


    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'author_id' => 'required|exists:users,id',
        'sections.*.section_title' => 'required|string',
        'sections.*.section_body' => 'required|string',
        'sections.*.order' => 'required|integer|min:1',
    ];

    // Reset pagination when search is updated
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Handle sorting logic
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    // Select a blog for editing
    public function selectBlogForEdit($blogId)
    {
        $this->selectedBlogId = $blogId;
        $this->loadBlog();
        $this->isEditing = true;
    }

    // Load blog data for editing
    public function loadBlog()
    {
        $blog = Blog::with('sections')->findOrFail($this->selectedBlogId);

        $this->title = $blog->title;
        $this->author_id = $blog->author_id;
        $this->sections = $blog->sections->toArray();
        $this->deletedSections = [];
    }

    // Update the blog and its sections
    public function updateBlog()
    {
        $this->validate();

        $blog = Blog::findOrFail($this->selectedBlogId);
        $blog->update([
            'title' => $this->title,
            'author_id' => $this->author_id,
        ]);

        // Delete removed sections
        if (!empty($this->deletedSections)) {
            BlogSection::whereIn('id', $this->deletedSections)->delete();
        }

        // Update existing sections and create new ones
        foreach ($this->sections as $section) {
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
                BlogSection::create([
                    'blog_id' => $this->selectedBlogId,
                    'section_title' => $section['section_title'],
                    'section_body' => $section['section_body'],
                    'order' => $section['order'],
                ]);
            }
        }

        // Reassign order to maintain consistency
        $this->reorderSections();

        session()->flash('message', 'Blog updated successfully.');
        $this->isEditing = false;
    }

    // Add a new section
    public function addSection()
    {
        $this->sections[] = [
            'section_title' => '',
            'section_body' => '',
            'order' => count($this->sections) + 1,
        ];
    }

    // Remove a section
    public function removeSection($index)
    {
        if (isset($this->sections[$index]['id'])) {
            $this->deletedSections[] = $this->sections[$index]['id'];
        }
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections); // Re-index the array

        // Reassign order
        $this->reorderSections();
    }

    // Reassign the order of sections
    private function reorderSections()
    {
        foreach ($this->sections as $i => &$section) {
            $section['order'] = $i + 1;
        }
    }

    // Cancel editing
    public function cancelEdit()
    {
        $this->resetEditing();
    }

    // Reset editing properties
    private function resetEditing()
    {
        $this->selectedBlogId = null;
        $this->title = '';
        $this->author_id = '';
        $this->sections = [];
        $this->deletedSections = [];
        $this->isEditing = false;
    }

    // Delete a blog
    public function deleteBlog($blogId)
    {
        Blog::findOrFail($blogId)->delete();
        session()->flash('message', 'Blog deleted successfully.');
    }
    public function render()
    {
        $blogs = Blog::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhereHas('author', function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.blogs.blogs-list', [
            'blogs' => $blogs,
        ]);
    }
}
