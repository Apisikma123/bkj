<x-public-layout>
    @php $locale = app()->getLocale(); @endphp
    <x-slot name="title">{{ __('pages.gallery_title') }}</x-slot>
    <x-slot name="description">Dokumentasi aktivitas operasional dan infrastruktur PT Bintang Kepri Jaya.</x-slot>
    
    <x-seo.meta title="{{ __('pages.gallery_title') }}" description="Dokumentasi aktivitas operasional dan infrastruktur PT Bintang Kepri Jaya." />

    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-outline-variant/10 opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-surface to-transparent"></div>
        </div>
        <x-layout.container class="relative z-10 text-center">
            <span class="text-label-md text-secondary tracking-widest uppercase mb-4 block">{{ __('pages.gallery_subtitle') }}</span>
            <h1 class="text-display-lg text-primary font-bold">{{ __('pages.gallery_title') }}</h1>
        </x-layout.container>
    </div>

    <section class="py-12 pb-32 bg-surface min-h-screen" data-scroll-reveal>
        <x-layout.container>
            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                @forelse($galleries as $index => $gallery)
                    <div class="group relative overflow-hidden rounded-2xl shadow-ambient cursor-pointer break-inside-avoid">
                        @if(!empty($gallery->image_path))
                            <x-ui.image src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105" />
                        @else
                            <div class="w-full h-64 bg-outline-variant/10"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                @php
                                    $galleryTitle = $locale === 'en' && !empty($gallery->title_en) ? $gallery->title_en : $gallery->title;
                                    $galleryCat = $locale === 'en' && !empty($gallery->category_en) ? $gallery->category_en : $gallery->category;
                                @endphp
                                <h3 class="text-white font-bold text-headline-md mb-2">{{ $galleryTitle }}</h3>
                                @if($gallery->category || $gallery->category_en)
                                    <span class="text-secondary font-semibold text-label-md uppercase tracking-wider">{{ $galleryCat }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-24 col-span-full">
                        <div class="w-20 h-20 bg-outline-variant/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <x-lucide-image class="w-10 h-10 text-outline" />
                        </div>
                        <p class="text-headline-md font-bold text-primary mb-2">{{ $locale === 'en' ? 'Gallery is Empty' : 'Galeri Kosong' }}</p>
                        <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'No operational documentation published yet.' : 'Belum ada dokumentasi operasional yang dipublikasikan.' }}</p>
                    </div>
                @endforelse
            </div>
            
            @if($galleries->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $galleries->links() }}
                </div>
            @endif
        </x-layout.container>
    </section>
</x-public-layout>