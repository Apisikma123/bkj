<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <x-admin.page-header title="Edit News" subtitle="Update existing article." />
            <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors shadow-sm flex items-center gap-2">
                <x-lucide-arrow-left class="w-4 h-4"/> Back to list
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" id="blog-form">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 space-y-6">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <x-input-label for="title" value="Title" required />
                                <x-text-input id="title" name="title" type="text" value="{{ old('title', $blog->title) }}" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="content" value="Content" required />
                            <input type="hidden" name="content" id="content" value="{{ old('content', $blog->content) }}">
                            <div id="editor" class="min-h-[400px] rounded-b-lg border-gray-300">{!! old('content', $blog->content) !!}</div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <h4 class="font-medium text-gray-900 mb-4">Publishing</h4>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="status" value="Status" required />
                                    <x-select-input name="status" id="status" required>
                                        <option value="draft" {{ $blog->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ $blog->status === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ $blog->status === 'archived' ? 'selected' : '' }}>Archived</option>
                                        <option value="expired" {{ $blog->status === 'expired' ? 'selected' : '' }}>Expired</option>
                                    </x-select-input>
                                </div>
                                <div>
                                    <x-input-label for="category" value="Category" />
                                    <x-text-input name="category" id="category" placeholder="e.g. Technology, Lifestyle" value="{{ old('category', $blog->category) }}" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <h4 class="font-medium text-gray-900 mb-4">Thumbnail</h4>
                            @if($blog->thumbnail)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($blog->thumbnail) }}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            <p class="text-xs text-gray-500 mt-2">Maksimal 2 MB, format akan diconvert ke WebP</p>
                            @error('thumbnail') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <x-primary-button class="w-full justify-center text-center">
                            <x-lucide-save class="w-5 h-5 mr-2"/> Update Article
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
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
        
        document.getElementById('blog-form').onsubmit = function() {
            document.getElementById('content').value = quill.root.innerHTML;
        };
    </script>
    <style>
        .ql-toolbar.ql-snow { border-radius: 0.5rem 0.5rem 0 0; border-color: #d1d5db; }
        .ql-container.ql-snow { border-radius: 0 0 0.5rem 0.5rem; border-color: #d1d5db; font-family: inherit; font-size: 1rem; }
    </style>
    @endpush
</x-admin-layout>