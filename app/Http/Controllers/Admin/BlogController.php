<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Services\MediaService;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = Blog::with('author')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $blogs = $query->paginate(10);
        return view('admin.blogs.index', compact('blogs', 'status'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request, MediaService $mediaService)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'status' => 'required|in:draft,published,expired,archived',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ], [
            'thumbnail.max' => 'The thumbnail must not exceed 2MB.'
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        $data['author_id'] = auth()->id();
        
        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $mediaData = $mediaService->storeAndProcess($request->file('thumbnail'), 'blogs');
            $data['thumbnail'] = $mediaData['path'];
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'News created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog, MediaService $mediaService)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'status' => 'required|in:draft,published,expired,archived',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ], [
            'thumbnail.max' => 'The thumbnail must not exceed 2MB.'
        ]);

        if ($data['title'] !== $blog->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        if ($data['status'] === 'published' && $blog->status !== 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $mediaData = $mediaService->storeAndProcess($request->file('thumbnail'), 'blogs');
            $data['thumbnail'] = $mediaData['path'];
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'News updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'News deleted successfully.');
    }
}
