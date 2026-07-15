<x-admin-layout>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-md bg-white border border-outline-variant/30 flex items-center justify-center text-primary shadow-sm">
                <x-lucide-image class="w-5 h-5" />
            </div>
            <h1 class="text-headline-md font-bold text-primary">Galleries</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-container transition-colors font-medium text-sm shadow-sm">
                <x-lucide-plus class="w-4 h-4 mr-2" /> Upload Images
            </a>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <form action="{{ route('admin.galleries.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <x-text-input name="q" value="{{ request('q') }}" placeholder="Cari judul galeri..." class="w-full text-lg py-3 px-4" />
            </div>
            <div class="w-full md:w-56">
                <x-text-input name="category" value="{{ request('category') }}" placeholder="Cari kategori..." class="w-full text-lg py-3 px-4" />
            </div>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
                    Cari
                </button>
                @if(request('q') || request('category'))
                    <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-red-50 text-red-700 font-bold rounded-xl hover:bg-red-100 transition-colors text-lg">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <x-admin.table :headers="['Image', 'Title', 'Category', 'Featured', 'Status']">
        @forelse($galleries as $item)
            <tr>
                <td class="px-6 py-4">
                    @if($item->image_path)
                        <div class="w-16 h-12 rounded-lg bg-gray-100 overflow-hidden border border-gray-200">
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-16 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                            <x-lucide-image class="w-6 h-6" />
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $item->title }}</td>
                <td class="px-6 py-4">
                    <span class="text-sm text-gray-600">{{ $item->category ?? '-' }}</span>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.galleries.toggle-featured', $item) }}" method="POST" data-no-alert>
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="p-1.5 rounded-lg transition-colors {{ $item->is_featured ? 'text-amber-500 bg-amber-50 hover:bg-amber-100' : 'text-gray-400 hover:text-amber-500 hover:bg-gray-100' }}" title="Toggle Featured">
                            <x-lucide-star class="w-5 h-5 {{ $item->is_featured ? 'fill-current' : '' }}" />
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.galleries.toggle-status', $item) }}" method="POST" data-no-alert>
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-3 py-1 text-xs font-medium rounded-full transition-colors {{ $item->status === 'published' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ ucfirst($item->status) }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.galleries.edit', $item) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <x-lucide-edit class="w-4 h-4" />
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <div class="flex flex-col items-center justify-center">
                        <x-lucide-image class="w-12 h-12 text-gray-300 mb-3" />
                        <p class="font-medium">No galleries found.</p>
                        <p class="text-sm text-gray-400 mt-1">Try uploading some images or changing your search filters.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.table>
    
    @if($galleries->hasPages())
        <div class="mt-4">
            {{ $galleries->links() }}
        </div>
    @endif
</x-admin-layout>