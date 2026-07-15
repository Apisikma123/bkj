<x-admin-layout>
    <x-admin.page-header title="Upload Gallery Images" icon="plus" actionText="Back" actionRoute="{{ route('admin.galleries.index') }}" />

    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-2xl">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <x-input-label for="category" value="Category (Optional)" />
                <x-text-input name="category" id="category" class="block mt-1 w-full" type="text" value="{{ old('category') }}" placeholder="e.g. CSR, Operations" />
                @error('category')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <x-input-label for="images" value="Select Images" required />
                <input type="file" name="images[]" id="images" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer" accept="image/*" multiple required />
                <p class="text-xs text-outline mt-2">Bisa pilih banyak gambar. Maksimal 2 MB per gambar, format akan diconvert ke WebP.</p>
                @error('images')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Cancel</a>
                <x-primary-button>
                    <x-lucide-upload class="w-4 h-4 mr-2" /> Start Upload
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-layout>