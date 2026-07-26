<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <x-admin.page-header title="News Center" subtitle="Manage your latest news and articles." />
            <a href="{{ route('admin.blogs.create') }}" class="px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-2">
                <x-lucide-plus class="w-4 h-4"/> Create News
            </a>
        </div>

        <div class="flex gap-4">
            @foreach(['all' => 'All', 'published' => 'Published', 'draft' => 'Drafts', 'archived' => 'Archived'] as $key => $label)
                <a href="{{ route('admin.blogs.index', ['status' => $key]) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors border {{ $status === $key ? 'bg-primary/10 border-primary/20 text-primary' : 'bg-white border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <x-admin.table :headers="['Judul / Berita', 'Kategori', 'Status', 'Tanggal', 'Aksi']">
            @forelse($blogs as $blog)
                <tr class="hover:bg-surface-container-low/50 transition-colors group">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            @if($blog->thumbnail)
                                <img src="{{ Storage::url($blog->thumbnail) }}" alt="Thumbnail" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-outline">
                                    <x-lucide-image class="w-5 h-5"/>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-on-surface">{{ $blog->title }}</div>
                                <div class="text-xs text-outline truncate w-48">{{ Str::limit(strip_tags($blog->content), 30) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-outline">
                        {{ $blog->category ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'published' => 'bg-green-100 text-green-700',
                                'draft' => 'bg-surface-container text-on-surface-variant',
                                'archived' => 'bg-amber-100 text-amber-700',
                                'expired' => 'bg-red-100 text-red-700'
                            ];
                        @endphp
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statusColors[$blog->status] ?? 'bg-surface-container text-on-surface-variant' }} capitalize">
                            {{ $blog->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">
                        {{ $blog->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="p-2 text-outline hover:text-primary transition-colors bg-white border border-surface-container-highest rounded-lg shadow-sm hover:shadow" title="Edit">
                                <x-lucide-edit class="w-4 h-4"/>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline-block" data-no-alert>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-outline hover:text-red-500 transition-colors bg-white border border-surface-container-highest rounded-lg shadow-sm hover:shadow" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    <x-lucide-trash-2 class="w-4 h-4"/>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-outline">
                        <x-lucide-file-x class="w-12 h-12 mx-auto mb-3 opacity-50"/>
                        <p>No news found.</p>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
        
        @if($blogs->hasPages())
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>