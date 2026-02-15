<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display blog listing page (frontend)
     */
    public function index()
    {
        $blogs = Blog::published()->ordered()->paginate(9);

        return Inertia::render('BlogList', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Display single blog (frontend)
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->published()->firstOrFail();

        return Inertia::render('BlogDetails', [
            'blog' => $blog
        ]);
    }

    /**
     * Display blog management page (backend)
     */
    public function manage()
    {
        $blogs = Blog::orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Backend/Blogs/Index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Store a new blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        Blog::create($validated);

        return redirect()->back()->with('success', 'Blog created successfully!');
    }

    /**
     * Update an existing blog
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog->update($validated);

        return redirect()->back()->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete a blog
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }
}
