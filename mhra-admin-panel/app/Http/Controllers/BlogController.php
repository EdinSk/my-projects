<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Event;
use App\Models\BlogSection;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(4)->get();

        $events = Event::where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->take(4)
            ->get();

        return view('blogs.index', compact('blogs', 'events'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        // Logic to store blog post

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function show($id)
    {
        // Fetch the blog by its ID
        $blog = Blog::with('author')->findOrFail($id);

        // Fetch all sections of the blog, ordered by the 'order' field
        $sections = BlogSection::where('blog_id', $id)->orderBy('order')->get();

        // Fetch related blogs (blogs that this blog is related to)
        $relatedBlogs = $blog->relatedBlogs()->take(4)->get(); // Limit to 4

        // Fetch blogs related to this blog (the reverse relationship)
        $blogsRelatedTo = $blog->relatedToBlogs()->take(4)->get(); // Also limit to 4

        return view('blogs.show', compact('blog', 'sections', 'relatedBlogs', 'blogsRelatedTo'));
    }

    public function edit($id)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update blog post

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete blog post

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
