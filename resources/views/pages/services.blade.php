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
                    $hardcodedServices = [
                        [
                            'slug' => 'bongkar-muat',
                            'title' => $locale === 'en' ? 'Cargo Stevedoring' : 'Bongkar Muat',
                            'short_description' => $locale === 'en' ? 'Professional cargo loading and unloading services at the port with adequate equipment and trained human resources.' : 'Layanan bongkar muat kargo profesional di pelabuhan dengan peralatan memadai dan SDM terlatih.',
                            'content' => $locale === 'en' ? 'Our professional services are designed to ensure the efficiency and security of your supply chain.' : 'Layanan profesional kami dirancang untuk memastikan efisiensi dan keamanan rantai pasok Anda.',
                            'icon' => 'truck'
                        ],
                        [
                            'slug' => 'transportasi-logistik',
                            'title' => $locale === 'en' ? 'Logistics Transportation' : 'Transportasi Logistik',
                            'short_description' => $locale === 'en' ? 'Safe and timely logistics distribution throughout Indonesia.' : 'Distribusi logistik aman dan tepat waktu ke seluruh Indonesia.',
                            'content' => $locale === 'en' ? 'We provide end-to-end logistics transportation tailored to your business needs.' : 'Kami menyediakan transportasi logistik menyeluruh yang disesuaikan dengan kebutuhan bisnis Anda.',
                            'icon' => 'ship'
                        ],
                        [
                            'slug' => 'penyedia-tenaga-kerja',
                            'title' => $locale === 'en' ? 'Manpower Supply' : 'Penyedia Tenaga Kerja',
                            'short_description' => $locale === 'en' ? 'Competent and experienced stevedoring manpower (TKBM).' : 'Tenaga Kerja Bongkar Muat (TKBM) yang kompeten dan berpengalaman.',
                            'content' => $locale === 'en' ? 'Supported by highly trained personnel to support your operational needs.' : 'Didukung oleh personel terlatih untuk menunjang kebutuhan operasional Anda.',
                            'icon' => 'users'
                        ]
                    ];
                @endphp
                @foreach($hardcodedServices as $index => $service)
                    <div id="service-{{ $service['slug'] }}" class="flex flex-col lg:flex-row gap-16 items-center {{ $index % 2 !== 0 ? 'lg:flex-row-reverse' : '' }}">
                        <div class="w-full lg:w-1/2">
                            <div class="relative h-[400px] lg:h-[500px] rounded-[2rem] overflow-hidden shadow-ambient group">
                                <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition-colors duration-700 z-10"></div>
                                <div class="w-full h-full bg-outline-variant/10"></div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-8 shadow-sm">
                                @php
                                    try {
                                        echo \Illuminate\Support\Facades\Blade::render('<x-dynamic-component :component="\'lucide-\' . $icon" class="w-8 h-8" />', ['icon' => $service['icon']]);
                                    } catch (\Exception $e) {
                                        echo \Illuminate\Support\Facades\Blade::render('<x-lucide-package class="w-8 h-8" />');
                                    }
                                @endphp
                            </div>
                            <h2 class="text-headline-lg font-bold text-primary mb-6">{{ $service['title'] }}</h2>
                            @if($service['short_description'])
                                <p class="text-body-lg text-secondary font-medium mb-6">{{ $service['short_description'] }}</p>
                            @endif
                            <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none mb-10">
                                {!! $service['content'] !!}
                            </div>
                            <x-ui.button variant="primary" href="{{ route('contact') }}">{{ $locale === 'en' ? 'Consult Now' : 'Konsultasi Sekarang' }}</x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-layout.container>
    </section>
</x-public-layout>