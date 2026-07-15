<x-admin-layout>
    <x-admin.page-header title="Edit Gallery Image" icon="edit" actionText="Back" actionRoute="{{ route('admin.galleries.index') }}" />

    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-2xl">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <x-input-label for="title" value="Title" required />
                    <x-text-input id="title" name="title" type="text" value="{{ old('title', $gallery->title) }}" required />
                    @error('title')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <x-input-label for="category" value="Category" />
                    <x-text-input name="category" id="category" placeholder="e.g. CSR, Operations" value="{{ old('category', $gallery->category) }}" />
                    @error('category')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <x-input-label for="status" value="Status" required />
                <x-select-input name="status" id="status" required>
                    <option value="published" {{ $gallery->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $gallery->status == 'draft' ? 'selected' : '' }}>Draft</option>
                </x-select-input>
                @error('status')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <x-admin.image-cropper 
                    id="image" 
                    name="image" 
                    label="Replace Image (Optional)" 
                    description="Maksimal 2 MB, format akan diconvert ke WebP. Bisa dipotong dengan rasio bebas."
                    aspect-ratio="NaN"
                    :current-image-url="$gallery->image_path ? Storage::url($gallery->image_path) : null"
                />
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Cancel</a>
                <x-primary-button>
                    <x-lucide-save class="w-4 h-4 mr-2" /> Update Image
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-layout>