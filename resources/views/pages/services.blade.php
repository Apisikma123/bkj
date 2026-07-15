<x-public-layout>
    <x-slot name="title">{{ __('pages.services_title') }}</x-slot>
    <x-slot name="description">Eksplorasi layanan bongkar muat, keagenan kapal, dan logistik menyeluruh dari BKJ Group.</x-slot>
    
    <x-seo.meta title="{{ __('pages.services_title') }}" description="Eksplorasi layanan bongkar muat, keagenan kapal, dan logistik menyeluruh dari BKJ Group." />

    {{-- Hero Page --}}
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-outline-variant/10 opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-primary/50 to-primary"></div>
        </div>
        <x-layout.container class="relative z-10 text-center">
            <span class="text-label-md text-secondary tracking-widest uppercase mb-4 block">{{ __('pages.services_subtitle') }}</span>
            <h1 class="text-display-lg text-white font-bold">{{ __('pages.services_title') }}</h1>
        </x-layout.container>
    </div>

    {{-- Services List (Detailed View instead of cards) --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="space-y-32">
                @php
                    $locale = app()->getLocale();
                @endphp
                @foreach($services as $index => $service)
                    @php
                        $title = $locale === 'en' && !empty($service->title_en) ? $service->title_en : $service->title;
                        $shortDescription = $locale === 'en' && !empty($service->short_description_en) ? $service->short_description_en : $service->short_description;
                        $content = $locale === 'en' && !empty($service->content_en) ? $service->content_en : $service->content;
                    @endphp
                    <div id="service-{{ $service->slug }}" class="flex flex-col lg:flex-row gap-16 items-center {{ $index % 2 !== 0 ? 'lg:flex-row-reverse' : '' }}">
                        <div class="w-full lg:w-1/2">
                            <div class="relative h-[400px] lg:h-[500px] rounded-[2rem] overflow-hidden shadow-ambient group flex items-center justify-center bg-primary/5 border border-outline-variant/10">
                                <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors duration-700 z-10"></div>
                                @if($service->image_path)
                                    <img src="{{ Storage::url($service->image_path) }}" alt="{{ $title }}" class="w-full h-full object-cover relative z-0 transition-transform duration-700 group-hover:scale-105">
                                @elseif(!empty($globalSettings['global_icon']))
                                    <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="BKJ Group Service Fallback" class="max-w-[40%] max-h-[60%] object-contain opacity-30 group-hover:opacity-50 transition-opacity duration-700" loading="lazy" decoding="async">
                                @else
                                    <div class="w-full h-full bg-outline-variant/10"></div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-8 shadow-sm overflow-hidden">
                                @if($service->image_path)
                                    <img src="{{ Storage::url($service->image_path) }}" alt="{{ $title }}" class="w-full h-full object-cover">
                                @else
                                    @php
                                        try {
                                            echo \Illuminate\Support\Facades\Blade::render('<x-dynamic-component :component="\'lucide-\' . $icon" class="w-8 h-8" />', ['icon' => $service->icon]);
                                        } catch (\Exception $e) {
                                            echo \Illuminate\Support\Facades\Blade::render('<x-lucide-package class="w-8 h-8" />');
                                        }
                                    @endphp
                                @endif
                            </div>
                            <h2 class="text-headline-lg font-bold text-primary mb-6">{{ $title }}</h2>
                            @if($shortDescription)
                                <p class="text-body-lg text-secondary font-medium mb-6">{{ $shortDescription }}</p>
                            @endif
                            <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none mb-10">
                                {!! $content !!}
                            </div>
                            <x-ui.button variant="primary" href="{{ route('contact') }}">{{ $locale === 'en' ? 'Consult Now' : 'Konsultasi Sekarang' }}</x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-layout.container>
    </section>
</x-public-layout>