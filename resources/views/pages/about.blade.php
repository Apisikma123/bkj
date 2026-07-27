<x-public-layout>
    <x-slot name="title">{{ __('pages.about_title') }}</x-slot>
    <x-slot name="description">{{ $companyProfile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi Bintang Kepri Jaya (BKJ Group).' }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.about_title') }}" description="{{ $companyProfile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi Bintang Kepri Jaya (BKJ Group).' }}" />

    {{-- Hero Page --}}
    <div class="relative pt-24 pb-12 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if(!empty($globalSettings['global_icon']))
                <div class="w-full h-full flex items-center justify-center opacity-10">
                    <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="Hero About" class="max-w-[30%] max-h-[80%] object-contain" />
                </div>
            @else
                <div class="w-full h-full bg-outline-variant/10 opacity-20"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-primary to-transparent"></div>
        </div>
        <x-layout.container class="relative z-10 text-center">
            <span class="text-label-md text-secondary tracking-widest uppercase mb-4 block">{{ __('pages.about_subtitle') }}</span>
            <h1 class="text-display-lg text-white font-bold">{{ __('pages.about_title') }}</h1>
        </x-layout.container>
    </div>

    @php
        $locale = app()->getLocale();
        $description = $locale === 'en' && !empty($companyProfile['description_en']) ? $companyProfile['description_en'] : ($companyProfile['description'] ?? '');
        $vision = $locale === 'en' && !empty($companyProfile['vision_en']) ? $companyProfile['vision_en'] : ($companyProfile['vision'] ?? '');
        $mission = $locale === 'en' && !empty($companyProfile['mission_en']) ? $companyProfile['mission_en'] : ($companyProfile['mission'] ?? '');
    @endphp

    {{-- Sejarah / Company Profile --}}
    <section class="py-12 md:py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
                <div class="w-full lg:w-5/12">
                    <div class="sticky top-32">
                        <span class="text-label-md text-secondary tracking-widest uppercase">{{ __('pages.about_history') }}</span>
                        <h2 class="text-headline-lg font-bold text-primary mt-4 mb-6">
                            {{ $companyProfile['name'] ?? 'Bintang Kepri Jaya' }}
                        </h2>
                        <div class="w-20 h-2 bg-secondary rounded-full mb-8"></div>
                        <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none">
                            {!! !empty($description) ? nl2br(e($description)) : '' !!}
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-7/12">
                    <div class="grid grid-cols-2 gap-6 items-center">
                        @if(!empty($companyProfile['image']))
                            <div class="col-span-2 w-full h-[250px] md:h-[400px] lg:h-[500px] bg-primary/5 rounded-2xl shadow-ambient mt-12 flex items-center justify-center p-2 border border-outline-variant/10 overflow-hidden">
                                <img src="{{ Storage::url($companyProfile['image']) }}" alt="BKJ Group History Image" class="w-full h-full object-cover rounded-xl" loading="lazy" decoding="async">
                            </div>
                        @else
                            @if(!empty($globalSettings['global_icon']))
                                <div class="w-full h-[250px] md:h-[400px] bg-primary/5 rounded-2xl shadow-ambient mt-12 flex items-center justify-center p-8 border border-outline-variant/10">
                                    <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="BKJ Group History Logo 1" class="max-w-full max-h-full object-contain" loading="lazy" decoding="async">
                                </div>
                            @else
                                <div class="w-full h-[250px] md:h-[400px] bg-outline-variant/10 rounded-2xl shadow-ambient mt-12"></div>
                            @endif

                            @if(!empty($globalSettings['global_icon']))
                                <div class="w-full h-[300px] md:h-[500px] bg-primary/5 rounded-2xl shadow-ambient flex items-center justify-center p-8 border border-outline-variant/10">
                                    <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="BKJ Group History Logo 2" class="max-w-full max-h-full object-contain" loading="lazy" decoding="async">
                                </div>
                            @else
                                <div class="w-full h-[300px] md:h-[500px] bg-outline-variant/20 rounded-2xl shadow-ambient"></div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-16 md:py-32 bg-surface-container-lowest" data-scroll-reveal>
        <x-layout.container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="bg-primary text-white p-6 md:p-12 lg:p-16 rounded-2xl md:rounded-[2rem] shadow-hover relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 text-white/5 group-hover:scale-110 transition-transform duration-700">
                        <x-lucide-eye class="w-64 h-64" />
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-secondary text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <x-lucide-eye class="w-8 h-8" />
                        </div>
                        <h3 class="text-headline-lg font-bold mb-6">{{ __('pages.about_vision') }}</h3>
                        <div class="text-body-lg text-white/90 leading-relaxed prose prose-invert">
                            {!! nl2br(e(!empty($vision) ? $vision : '')) !!}
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border border-outline-variant/30 p-6 md:p-12 lg:p-16 rounded-2xl md:rounded-[2rem] shadow-ambient relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 text-primary/5 group-hover:scale-110 transition-transform duration-700">
                        <x-lucide-target class="w-64 h-64" />
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-primary text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <x-lucide-target class="w-8 h-8" />
                        </div>
                        <h3 class="text-headline-lg font-bold text-primary mb-6">{{ __('pages.about_mission') }}</h3>
                        <div class="text-body-lg text-on-surface-variant leading-relaxed prose">
                            {!! nl2br(e(!empty($mission) ? $mission : '')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>




</x-public-layout>