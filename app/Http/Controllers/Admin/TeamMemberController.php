<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $branch = $request->get('branch', 'main');
        $query = TeamMember::where('branch', $branch)->orderBy('order')->orderBy('name');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('role', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        $members = $query->paginate(10)->withQueryString();

        return view('admin.team-members.index', compact('members', 'branch'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'branch' => 'required|in:main,koperasi',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'level' => 'required|in:commissioner,director,manager,operational,supervisor,management',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $translator = app(\App\Services\TranslationService::class);
        $data['role_en'] = $translator->translateToEnglish($data['role']);

        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Services\ImageService::upload($request->file('image'), 'team-members');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'branch' => 'required|in:main,koperasi',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'level' => 'required|in:commissioner,director,manager,operational,supervisor,management',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $translator = app(\App\Services\TranslationService::class);
        $data['role_en'] = $translator->translateToEnglish($data['role']);

        if ($request->hasFile('image')) {
            $data['image_path'] = \App\Services\ImageService::upload($request->file('image'), 'team-members', $teamMember->image_path);
        }

        $teamMember->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image_path) {
            \App\Services\ImageService::delete($teamMember->image_path);
        }
        $teamMember->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
