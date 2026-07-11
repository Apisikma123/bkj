<x-public-layout>
    <x-slot name="title">{{ __('pages.about_title') }}</x-slot>
    <x-slot name="description">{{ $profile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi PT Bintang Kepri Jaya (BKJ Group).' }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.about_title') }}" description="{{ $profile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi PT Bintang Kepri Jaya (BKJ Group).' }}" />

    {{-- Hero Page --}}
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if(!empty($profile['image']))
                <x-ui.image src="{{ Storage::url($profile['image']) }}" alt="Hero About" class="w-full h-full object-cover opacity-20" />
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
        $description = $locale === 'en' && !empty($profile['description_en']) ? $profile['description_en'] : ($profile['description'] ?? '');
        $vision = $locale === 'en' && !empty($profile['vision_en']) ? $profile['vision_en'] : ($profile['vision'] ?? '');
        $mission = $locale === 'en' && !empty($profile['mission_en']) ? $profile['mission_en'] : ($profile['mission'] ?? '');
        
        $defaultDesc = 'PT Bintang Kepri Jaya bermula dari komitmen untuk meningkatkan kualitas rantai pasok maritim di Kepulauan Riau. Kami telah berkembang dari keagenan kapal kecil menjadi penyedia logistik terintegrasi berstandar nasional.';
        $defaultVision = 'Menjadi penyedia solusi jasa bongkar muat dan logistik terbaik dan terpercaya di Indonesia dengan standar operasional kelas dunia.';
        $defaultMission = 'Membangun ekosistem logistik yang efisien, inovatif, dan berfokus pada kepuasan pelanggan, serta memberdayakan sumber daya manusia lokal melalui Koperasi TKBM.';
    @endphp

    {{-- Sejarah / Company Profile --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col lg:flex-row gap-16">
                <div class="w-full lg:w-5/12">
                    <div class="sticky top-32">
                        <span class="text-label-md text-secondary tracking-widest uppercase">{{ __('pages.about_history') }}</span>
                        <h2 class="text-headline-lg font-bold text-primary mt-4 mb-6">
                            {{ $profile['name'] ?? 'PT Bintang Kepri Jaya' }}
                        </h2>
                        <div class="w-20 h-2 bg-secondary rounded-full mb-8"></div>
                        <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none">
                            {!! !empty($description) ? $description : $defaultDesc !!}
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-7/12">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="w-full h-[400px] bg-outline-variant/10 rounded-2xl shadow-ambient mt-12"></div>
                        @if(!empty($profile['image']))
                            <x-ui.image src="{{ Storage::url($profile['image']) }}" alt="Sejarah BKJ Group 2" class="w-full h-[500px] object-cover rounded-2xl shadow-ambient" />
                        @else
                            <div class="w-full h-[500px] bg-outline-variant/20 rounded-2xl shadow-ambient"></div>
                        @endif
                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-32 bg-surface-container-lowest" data-scroll-reveal>
        <x-layout.container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="bg-primary text-white p-12 lg:p-16 rounded-[2rem] shadow-hover relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 text-white/5 group-hover:scale-110 transition-transform duration-700">
                        <x-lucide-eye class="w-64 h-64" />
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-secondary text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <x-lucide-eye class="w-8 h-8" />
                        </div>
                        <h3 class="text-headline-lg font-bold mb-6">{{ __('pages.about_vision') }}</h3>
                        <div class="text-body-lg text-white/90 leading-relaxed prose prose-invert">
                            {!! nl2br(e(!empty($vision) ? $vision : $defaultVision)) !!}
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border border-outline-variant/30 p-12 lg:p-16 rounded-[2rem] shadow-ambient relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 text-primary/5 group-hover:scale-110 transition-transform duration-700">
                        <x-lucide-target class="w-64 h-64" />
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-primary text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <x-lucide-target class="w-8 h-8" />
                        </div>
                        <h3 class="text-headline-lg font-bold text-primary mb-6">{{ __('pages.about_mission') }}</h3>
                        <div class="text-body-lg text-on-surface-variant leading-relaxed prose">
                            {!! nl2br(e(!empty($mission) ? $mission : $defaultMission)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Tim & Legalitas --}}
    @php
        $team = $globalSettings['team_members'] ?? null;
        $legality = $globalSettings['company_legality'] ?? null;
    @endphp
    @if($team || $legality)
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                @if($team)
                <div>
                    <h2 class="text-headline-md font-bold text-primary mb-8">{{ $locale === 'en' ? 'Our Team' : 'Struktur Organisasi & Tim' }}</h2>
                    <div class="bg-white p-8 rounded-2xl shadow-ambient border border-outline-variant/30 text-body-lg text-on-surface-variant leading-relaxed">
                        <div class="prose max-w-none text-on-surface-variant">
                            {!! $team !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($legality)
                <div>
                    <h2 class="text-headline-md font-bold text-primary mb-8">{{ $locale === 'en' ? 'Company Legality' : 'Legalitas Perusahaan' }}</h2>
                    <div class="bg-white p-8 rounded-2xl shadow-ambient border border-outline-variant/30 text-body-lg text-on-surface-variant leading-relaxed">
                        <ul class="list-disc list-inside space-y-3">
                            @foreach(explode("\n", $legality) as $doc)
                                @if(trim($doc))
                                    <li>{{ trim($doc) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </x-layout.container>
    </section>
    @endif
</x-public-layout>