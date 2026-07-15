<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('short_description', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $services = $query->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'icon' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $translator = app(\App\Services\TranslationService::class);
        $data['title_en'] = $translator->translateToEnglish($data['title']);
        if (!empty($data['short_description'])) {
            $data['short_description_en'] = $translator->translateToEnglish($data['short_description']);
        }
        if (!empty($data['content'])) {
            $data['content_en'] = $translator->translateToEnglish($data['content']);
        }

        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Services\ImageService::upload($request->file('image'), 'services');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dibuat.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'icon' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $translator = app(\App\Services\TranslationService::class);
        $data['title_en'] = $translator->translateToEnglish($data['title']);
        if (!empty($data['short_description'])) {
            $data['short_description_en'] = $translator->translateToEnglish($data['short_description']);
        }
        if (!empty($data['content'])) {
            $data['content_en'] = $translator->translateToEnglish($data['content']);
        }

        if ($data['title'] !== $service->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Services\ImageService::upload($request->file('image'), 'services', $service->image_path);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path) {
            \App\Services\ImageService::delete($service->image_path);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
