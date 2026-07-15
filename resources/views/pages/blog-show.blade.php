<x-public-layout>
    @php
        $locale = app()->getLocale();
        $blogTitle = $locale === 'en' && !empty($blog->title_en) ? $blog->title_en : $blog->title;
        $blogContent = $locale === 'en' && !empty($blog->content_en) ? $blog->content_en : $blog->content;
    @endphp
    <x-slot name="title">{{ $blogTitle }}</x-slot>
    <x-slot name="description">{{ Str::limit(strip_tags($blogContent), 150) }}</x-slot>
    
    <x-seo.meta title="{{ $blogTitle }}" description="{{ Str::limit(strip_tags($blogContent), 150) }}" image="{{ !empty($blog->thumbnail) ? Storage::url($blog->thumbnail) : '' }}" />

    <article class="pt-24 md:pt-32 pb-16 md:pb-32 bg-surface min-h-screen">
        <x-layout.container>
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('blog') }}" class="inline-flex items-center text-on-surface-variant hover:text-primary transition-colors text-label-md uppercase tracking-widest mb-10">
                    <x-lucide-arrow-left class="w-5 h-5 mr-2" /> {{ $locale === 'en' ? 'Back to News' : 'Kembali ke Berita' }}
                </a>
                
                <h1 class="text-display-lg font-bold text-primary leading-tight mb-6 md:mb-8 break-words">{{ $blogTitle }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 md:gap-6 mb-8 md:mb-12 border-b border-outline-variant/30 pb-6 md:pb-8">
                    <div class="flex items-center gap-2 text-on-surface-variant">
                        <x-lucide-calendar class="w-5 h-5" />
                        <span class="text-body-md font-medium">{{ $blog->created_at->format('d M Y') }}</span>
                    </div>
                    @if($blog->category)
                        <div class="flex items-center gap-2 px-3 py-1 bg-surface-container rounded-full text-on-surface-variant">
                            <x-lucide-folder class="w-4 h-4"/>
                            <span class="text-body-md font-medium">{{ $blog->category }}</span>
                        </div>
                    @endif
                </div>
                
                @if($blog->thumbnail)
                    <div class="w-full h-[220px] md:h-[400px] lg:h-[600px] rounded-2xl md:rounded-3xl overflow-hidden shadow-ambient mb-8 md:mb-16">
                        <x-ui.image src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" />
                    </div>
                @endif
                
                <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none">
                    {!! $blogContent !!}
                </div>
            </div>
        </x-layout.container>
    </article>
</x-public-layout>
