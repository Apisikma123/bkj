<x-admin-layout>
    <x-admin.page-header title="Edit Subsidiary" icon="edit" backRoute="{{ route('admin.subsidiaries.index') }}" />
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-4xl">
        <form action="{{ route('admin.subsidiaries.update', $subsidiary) }}" method="POST" id="subsidiary-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <x-input-label for="name" value="Name" required />
                    <x-text-input id="name" name="name" type="text" value="{{ old('name', $subsidiary->name) }}" required />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="url" value="External URL (Optional)" />
                    <x-text-input id="url" name="url" type="url" value="{{ old('url', $subsidiary->url) }}" placeholder="https://..." />
                </div>
            </div>

            <div class="mb-6">
                <x-input-label for="hero_image" value="Hero Background Image (Optional)" />
                <input type="file" name="hero_image" id="hero_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer">
                <p class="text-xs text-on-surface-variant mt-1">Maksimal 2 MB, format akan diconvert ke WebP</p>
                @error('hero_image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                @if(!empty($subsidiary->hero_image))
                    <div class="mt-3">
                        <p class="text-sm font-medium text-on-surface mb-2">Current Image:</p>
                        <img src="{{ Storage::url($subsidiary->hero_image) }}" class="h-32 object-cover border border-outline-variant/30 rounded-lg">
                    </div>
                @endif
            </div>

            <div class="mb-6">
                <x-input-label for="description" value="Short Description" />
                <x-textarea-input id="description" name="description" rows="3">{{ old('description', $subsidiary->description) }}</x-textarea-input>
            </div>
            <div class="mb-6">
                <x-input-label for="content" value="Page Content (Rich Text)" />
                <input type="hidden" name="content" id="content">
                <div id="editor" class="min-h-[400px] rounded-b-lg border-gray-300">{!! old('content', $subsidiary->content) !!}</div>
            </div>
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('admin.subsidiaries.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Cancel</a>
                <x-primary-button>
                    <x-lucide-save class="w-4 h-4 mr-2" /> Update Subsidiary
                </x-primary-button>
            </div>
        </form>
    </div>

    @push('scripts')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });
        document.getElementById('subsidiary-form').onsubmit = function() {
            document.getElementById('content').value = quill.root.innerHTML;
        };
    </script>
    <style>
        .ql-toolbar.ql-snow { border-radius: 0.5rem 0.5rem 0 0; border-color: #d1d5db; }
        .ql-container.ql-snow { border-radius: 0 0 0.5rem 0.5rem; border-color: #d1d5db; font-family: inherit; font-size: 1rem; }
    </style>
    @endpush
</x-admin-layout>