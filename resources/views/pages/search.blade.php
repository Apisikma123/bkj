<x-public-layout>
    @php $locale = app()->getLocale(); @endphp
    <x-slot name="title">{{ $locale === 'en' ? 'Search' : 'Pencarian' }}</x-slot>
    <x-slot name="description">{{ $locale === 'en' ? 'Search results for your query.' : 'Hasil pencarian untuk kueri Anda.' }}</x-slot>
    
    <x-seo.meta title="{{ $locale === 'en' ? 'Search' : 'Pencarian' }}" description="{{ $locale === 'en' ? 'Search results for your query.' : 'Hasil pencarian untuk kueri Anda.' }}" />

    <section class="py-32 bg-surface min-h-screen">
        <x-layout.container>
            <div class="max-w-4xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="mb-12 relative">
                    <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="{{ $locale === 'en' ? 'Type search keywords...' : 'Ketik kata kunci pencarian...' }}" class="w-full pl-14 pr-6 py-5 bg-white border border-outline-variant/50 rounded-2xl shadow-ambient focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-headline-md text-primary">
                    <x-lucide-search class="w-6 h-6 text-on-surface-variant absolute left-6 top-1/2 -translate-y-1/2" />
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 bg-primary text-white px-6 py-2 rounded-xl hover:bg-primary/90 transition-colors font-bold">{{ $locale === 'en' ? 'Search' : 'Cari' }}</button>
                </form>

                @if(isset($query) && $query != '')
                    <div class="mb-8 border-b border-outline-variant/30 pb-4 flex items-center justify-between">
                        <h2 class="text-title-lg text-primary font-bold">{{ $locale === 'en' ? 'Search Results for:' : 'Hasil Pencarian untuk:' }} "<span class="text-secondary">{{ $query }}</span>"</h2>
                        <span class="bg-surface-container-low text-primary text-label-md px-3 py-1 rounded-lg border border-outline-variant/30">{{ count($results) }} {{ $locale === 'en' ? 'found' : 'ditemukan' }}</span>
                    </div>

                    @if(count($results) > 0)
                        <div class="space-y-6">
                            @foreach($results as $result)
                                <a href="{{ route('blog.show', $result->slug ?? '#') }}" class="block bg-white p-8 rounded-2xl shadow-sm hover:shadow-ambient border border-outline-variant/30 transition-all duration-300 group">
                                    @php
                                        $resultTitle = $locale === 'en' && !empty($result->title_en) ? $result->title_en : $result->title;
                                        $resultContent = $locale === 'en' && !empty($result->content_en) ? $result->content_en : $result->content;
                                    @endphp
                                    <h3 class="text-title-lg font-bold text-primary mb-3 group-hover:text-secondary transition-colors">{{ $resultTitle }}</h3>
                                    <p class="text-body-md text-on-surface-variant line-clamp-2">{{ Str::limit(strip_tags($resultContent), 200) }}</p>
                                    <div class="mt-4 flex items-center gap-4 text-xs font-bold text-primary uppercase tracking-wider">
                                        <span>{{ $locale === 'en' ? 'Article' : 'Artikel' }}</span>
                                        <span class="w-1 h-1 bg-outline rounded-full"></span>
                                        <span>{{ $result->created_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-20 bg-white rounded-[2rem] border border-outline-variant/30">
                            <div class="w-24 h-24 bg-surface-container-lowest rounded-full flex items-center justify-center mx-auto mb-6 text-outline">
                                <x-lucide-search-x class="w-10 h-10" />
                            </div>
                            <h3 class="text-headline-md font-bold text-primary mb-2">{{ $locale === 'en' ? 'Not Found' : 'Tidak Ditemukan' }}</h3>
                            <p class="text-body-lg text-on-surface-variant max-w-md mx-auto">{{ $locale === 'en' ? 'We couldn\'t find any results matching your search. Try different keywords or check your spelling.' : 'Kami tidak dapat menemukan hasil apa pun yang cocok dengan pencarian Anda. Coba kata kunci lain atau periksa ejaan Anda.' }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </x-layout.container>
    </section>
</x-public-layout>
