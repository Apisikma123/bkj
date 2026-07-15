<x-public-layout>
    @php $locale = app()->getLocale(); @endphp
    <x-slot name="title">{{ __('pages.blog_title') }}</x-slot>
    <x-slot name="description">{{ $locale === 'en' ? 'Latest news about the logistics and maritime industry, and BKJ Group developments.' : 'Berita terbaru seputar industri logistik, maritim, dan perkembangan BKJ Group.' }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.blog_title') }}" description="{{ $locale === 'en' ? 'Latest news about the logistics and maritime industry, and BKJ Group developments.' : 'Berita terbaru seputar industri logistik, maritim, dan perkembangan BKJ Group.' }}" />

    <div class="relative pt-32 pb-24 bg-primary" id="hero">
        <x-layout.container class="relative z-10 text-left">
            <span class="text-label-md text-secondary tracking-widest uppercase font-bold block mb-4" data-hero-text>{{ __('pages.blog_subtitle') }}</span>
            <h1 class="text-headline-lg md:text-display-sm text-white font-bold max-w-4xl leading-tight" data-hero-text>{{ __('pages.blog_title') }}</h1>
        </x-layout.container>
    </div>

    <section class="py-16 pb-32 bg-surface min-h-screen" data-scroll-reveal>
        <x-layout.container>
            
            @if(isset($blogs[0]) && $blogs->currentPage() == 1)
                {{-- Featured Post --}}
                <div class="mb-20">
                    <div class="group relative rounded-2xl md:rounded-[2.5rem] overflow-hidden shadow-ambient h-[300px] md:h-[500px] cursor-pointer block">
                        @if(!empty($blogs[0]->thumbnail))
                            <x-ui.image src="{{ Storage::url($blogs[0]->thumbnail) }}" alt="{{ $blogs[0]->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
                        @else
                            <div class="w-full h-full bg-outline-variant/10"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/40 to-transparent"></div>
                        @php
                            $featuredTitle = $locale === 'en' && !empty($blogs[0]->title_en) ? $blogs[0]->title_en : $blogs[0]->title;
                            $featuredContent = $locale === 'en' && !empty($blogs[0]->content_en) ? $blogs[0]->content_en : $blogs[0]->content;
                        @endphp
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 lg:p-16">
                            <span class="bg-secondary text-white text-label-md px-4 py-2 rounded-full mb-6 inline-block">Featured</span>
                            <h2 class="text-headline-lg md:text-display-lg text-white font-bold mb-4 line-clamp-2 max-w-4xl group-hover:text-secondary-container transition-colors">{{ $featuredTitle }}</h2>
                            <p class="text-body-md md:text-body-lg text-white/80 max-w-3xl line-clamp-2 mb-4 md:mb-8 hidden md:block">{{ Str::limit(strip_tags($featuredContent), 150) }}</p>
                            <a href="{{ route('blog.show', $blogs[0]->slug ?? '#') }}" class="inline-flex items-center text-white font-bold text-label-md uppercase tracking-wider group-hover:text-secondary transition-colors">
                                {{ $locale === 'en' ? 'Read Article' : 'Baca Artikel' }} <x-lucide-arrow-right class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" />
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" data-scroll-stagger>
                @forelse($blogs->skip($blogs->currentPage() == 1 ? 1 : 0) as $blog)
                    <div class="bg-white rounded-2xl md:rounded-3xl overflow-hidden border border-outline-variant/30 shadow-ambient hover-card-premium border-top-accent flex flex-col group">
                        <div class="relative h-60 overflow-hidden">
                            @if(!empty($blog->thumbnail))
                                <x-ui.image src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" />
                            @else
                                <div class="w-full h-full bg-outline-variant/10"></div>
                            @endif
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-sm text-primary text-xs font-bold px-3 py-1.5 rounded-lg">{{ $blog->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        @php
                            $blogTitle = $locale === 'en' && !empty($blog->title_en) ? $blog->title_en : $blog->title;
                            $blogContent = $locale === 'en' && !empty($blog->content_en) ? $blog->content_en : $blog->content;
                        @endphp
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-headline-md font-bold text-primary mb-4 line-clamp-2 group-hover:text-secondary transition-colors">{{ $blogTitle }}</h3>
                            <p class="text-body-md text-on-surface-variant mb-8 line-clamp-3 flex-grow">{{ Str::limit(strip_tags($blogContent), 120) }}</p>
                            <a href="{{ route('blog.show', $blog->slug ?? '#') }}" class="inline-flex items-center text-primary font-bold text-label-md uppercase tracking-wider group-hover:text-secondary transition-colors mt-auto">
                                {{ $locale === 'en' ? 'Read Article' : 'Baca Artikel' }} <x-lucide-arrow-right class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" />
                            </a>
                        </div>
                    </div>
                @empty
                    @if(!isset($blogs[0]))
                        <div class="col-span-full text-center py-24 bg-white rounded-[2rem] border border-outline-variant/30">
                            <div class="w-20 h-20 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-6 text-primary">
                                <x-lucide-newspaper class="w-10 h-10" />
                            </div>
                            <h3 class="text-headline-md font-bold text-primary mb-2">{{ $locale === 'en' ? 'No News Yet' : 'Belum Ada Berita' }}</h3>
                            <p class="text-body-lg text-on-surface-variant">{{ $locale === 'en' ? 'Latest updates will be coming soon.' : 'Update terbaru akan segera hadir.' }}</p>
                        </div>
                    @endif
                @endforelse
            </div>
            
            @if($blogs->hasPages())
                <div class="mt-20 flex justify-center">
                    {{ $blogs->links() }}
                </div>
            @endif
        </x-layout.container>
    </section>
</x-public-layout>