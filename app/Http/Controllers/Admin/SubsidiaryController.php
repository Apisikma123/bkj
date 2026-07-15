<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubsidiaryController extends Controller
{
    public function index()
    {
        $subsidiaries = Subsidiary::latest()->paginate(10);
        return view('admin.subsidiaries.index', compact('subsidiaries'));
    }

    public function create()
    {
        return view('admin.subsidiaries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = \App\Services\ImageService::upload($request->file('hero_image'), 'subsidiaries');
        }

        $translator = app(\App\Services\TranslationService::class);
        if (!empty($data['name'])) $data['name_en'] = $data['name']; // Do not translate proper names
        if (!empty($data['description'])) $data['description_en'] = $translator->translateToEnglish($data['description']);
        if (!empty($data['content'])) $data['content_en'] = $translator->translateToEnglish($data['content']);

        $data['slug'] = Str::slug($data['name']);
        Subsidiary::create($data);
        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary created successfully.');
    }

    public function edit(Subsidiary $subsidiary)
    {
        return view('admin.subsidiaries.edit', compact('subsidiary'));
    }

    public function update(Request $request, Subsidiary $subsidiary)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = \App\Services\ImageService::upload($request->file('hero_image'), 'subsidiaries', $subsidiary->hero_image);
        }

        $translator = app(\App\Services\TranslationService::class);
        if (!empty($data['name'])) $data['name_en'] = $data['name']; // Do not translate proper names
        if (!empty($data['description'])) $data['description_en'] = $translator->translateToEnglish($data['description']);
        if (!empty($data['content'])) $data['content_en'] = $translator->translateToEnglish($data['content']);

        $data['slug'] = Str::slug($data['name']);
        $subsidiary->update($data);
        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary updated successfully.');
    }

    public function destroy(Subsidiary $subsidiary)
    {
        $subsidiary->delete();
        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary deleted successfully.');
    }
}