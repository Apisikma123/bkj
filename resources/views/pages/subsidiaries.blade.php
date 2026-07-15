<x-public-layout>
    @php $locale = app()->getLocale(); @endphp
    <x-slot name="title">{{ __('pages.subsidiaries_title') }}</x-slot>
    <x-slot name="description">{{ $locale === 'en' ? 'The maritime and logistics ecosystem network of PT Bintang Kepri Jaya.' : 'Jaringan ekosistem maritim dan logistik PT Bintang Kepri Jaya.' }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.subsidiaries_title') }}" description="{{ $locale === 'en' ? 'The maritime and logistics ecosystem network of PT Bintang Kepri Jaya.' : 'Jaringan ekosistem maritim dan logistik PT Bintang Kepri Jaya.' }}" />

    <div class="relative pt-24 pb-12 lg:pt-48 lg:pb-32 bg-surface overflow-hidden">
        <x-layout.container class="relative z-10 text-center max-w-3xl">
            <span class="text-label-md text-secondary tracking-widest uppercase mb-4 block">{{ __('pages.subsidiaries_subtitle') }}</span>
            <h1 class="text-display-lg text-primary font-bold mb-6">{{ __('pages.subsidiaries_title') }}</h1>
            <p class="text-body-lg text-on-surface-variant">
                {{ $locale === 'en' ? 'The strength of BKJ Group services is supported by solid subsidiary entities focused on specific expertise in the logistics industry.' : 'Kekuatan layanan BKJ Group ditopang oleh entitas anak perusahaan yang solid dan berfokus pada keahlian spesifik dalam industri logistik.' }}
            </p>
        </x-layout.container>
    </div>

    <section class="py-12 pb-32 bg-surface min-h-screen" data-scroll-reveal>
        <x-layout.container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-scroll-stagger>
                @forelse($subsidiaries as $index => $sub)
                    <div class="bg-white rounded-[2rem] overflow-hidden border border-outline-variant/30 shadow-ambient flex flex-col hover-card-premium border-top-accent border-secondary group {{ $index % 3 == 0 ? 'md:col-span-2 md:flex-row' : '' }}">
                        <div class="relative {{ $index % 3 == 0 ? 'md:w-1/2 h-64 md:h-auto' : 'h-64' }}">
                            <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition-colors duration-700 z-10"></div>
                            <div class="w-full h-full bg-outline-variant/10"></div>
                        </div>
                        <div class="p-10 lg:p-12 flex flex-col justify-center {{ $index % 3 == 0 ? 'md:w-1/2' : '' }}">
                            <div class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6 shrink-0 transition-transform duration-300 group-hover:scale-110">
                                @php
                                    try {
                                        echo \Illuminate\Support\Facades\Blade::render('<x-dynamic-component :component="\'lucide-\' . $icon" class="w-7 h-7" />', ['icon' => $sub->icon ?? 'building-2']);
                                    } catch (\Exception $e) {
                                        echo \Illuminate\Support\Facades\Blade::render('<x-lucide-building-2 class="w-7 h-7" />');
                                    }
                                @endphp
                            </div>
                            <h3 class="text-headline-md font-bold text-primary mb-4">{{ $locale === 'en' && !empty($sub->name_en) ? $sub->name_en : $sub->name }}</h3>
                            <div class="prose prose-p:text-on-surface-variant max-w-none">
                                {!! ($locale === 'en' && !empty($sub->description_en)) ? $sub->description_en : ($sub->description ?? ($locale === 'en' ? 'Plays a vital role in the operational logistics ecosystem of BKJ Group.' : 'Berperan vital dalam operasional ekosistem logistik BKJ Group.')) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 bg-white rounded-2xl p-12 text-center border border-outline-variant/30">
                        <p class="text-body-lg text-on-surface-variant">{{ $locale === 'en' ? 'Subsidiary data is not available yet.' : 'Data anak perusahaan belum tersedia.' }}</p>
                    </div>
                @endforelse
            </div>
        </x-layout.container>
    </section>
</x-public-layout>