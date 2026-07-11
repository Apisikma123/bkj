<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(12)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'category' => 'nullable|string|max:255',
        ]);
        
        $count = 0;
        foreach ($request->file('images') as $image) {
            $path = \App\Services\ImageService::upload($image, 'galleries');
            $title = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            
            // Clean up title (remove dashes/underscores)
            $title = ucwords(str_replace(['-', '_'], ' ', $title));

            Gallery::create([
                'title' => $title,
                'image_path' => $path,
                'category' => $request->category,
                'status' => 'published',
                'is_featured' => false
            ]);
            $count++;
        }
        
        return redirect()->route('admin.galleries.index')->with('success', $count . ' gambar berhasil diunggah.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'category' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Services\ImageService::upload($request->file('image'), 'galleries', $gallery->image_path);
        }

        $gallery->update($data);
        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        \App\Services\ImageService::delete($gallery->image_path);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update([
            'status' => $gallery->status === 'published' ? 'draft' : 'published'
        ]);
        return redirect()->back()->with('success', 'Status gambar berhasil diubah.');
    }

    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update([
            'is_featured' => !$gallery->is_featured
        ]);
        return redirect()->back()->with('success', 'Status Featured berhasil diubah.');
    }
}