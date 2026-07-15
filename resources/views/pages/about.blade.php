<x-public-layout>
    <x-slot name="title">{{ __('pages.about_title') }}</x-slot>
    <x-slot name="description">{{ $companyProfile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi PT Bintang Kepri Jaya (BKJ Group).' }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.about_title') }}" description="{{ $companyProfile['meta_description'] ?? 'Pelajari lebih lanjut tentang sejarah, visi, dan misi PT Bintang Kepri Jaya (BKJ Group).' }}" />

    {{-- Hero Page --}}
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
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
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col lg:flex-row gap-16">
                <div class="w-full lg:w-5/12">
                    <div class="sticky top-32">
                        <span class="text-label-md text-secondary tracking-widest uppercase">{{ __('pages.about_history') }}</span>
                        <h2 class="text-headline-lg font-bold text-primary mt-4 mb-6">
                            {{ $companyProfile['name'] ?? 'PT Bintang Kepri Jaya' }}
                        </h2>
                        <div class="w-20 h-2 bg-secondary rounded-full mb-8"></div>
                        <div class="prose prose-lg prose-p:text-on-surface-variant prose-headings:text-primary max-w-none">
                            {!! !empty($description) ? nl2br(e($description)) : '' !!}
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-7/12">
                    <div class="grid grid-cols-2 gap-6 items-center">
                        @if(!empty($globalSettings['global_icon']))
                            <div class="w-full h-[400px] bg-primary/5 rounded-2xl shadow-ambient mt-12 flex items-center justify-center p-8 border border-outline-variant/10">
                                <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="BKJ Group History Logo 1" class="max-w-full max-h-full object-contain" loading="lazy" decoding="async">
                            </div>
                        @else
                            <div class="w-full h-[400px] bg-outline-variant/10 rounded-2xl shadow-ambient mt-12"></div>
                        @endif

                        @if(!empty($globalSettings['global_icon']))
                            <div class="w-full h-[500px] bg-primary/5 rounded-2xl shadow-ambient flex items-center justify-center p-8 border border-outline-variant/10">
                                <img src="{{ Storage::url($globalSettings['global_icon']) }}" alt="BKJ Group History Logo 2" class="max-w-full max-h-full object-contain" loading="lazy" decoding="async">
                            </div>
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
                            {!! nl2br(e(!empty($vision) ? $vision : '')) !!}
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
                            {!! nl2br(e(!empty($mission) ? $mission : '')) !!}
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
    @if(($teamMembers && $teamMembers->count() > 0) || $team || $legality)
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                @if($teamMembers && $teamMembers->count() > 0)
                <div>
                    <h2 class="text-headline-md font-bold text-primary mb-8">{{ $locale === 'en' ? 'Our Team' : 'Struktur Organisasi & Tim' }}</h2>
                    <div class="bg-white p-8 rounded-2xl shadow-ambient border border-outline-variant/30 text-body-lg text-on-surface-variant leading-relaxed">
                        <div class="space-y-6">
                            @foreach($teamMembers as $member)
                                <div class="flex justify-between items-center border-b border-outline-variant/10 pb-4 last:border-0 last:pb-0 gap-4">
                                    <div class="flex items-center gap-4 overflow-hidden">
                                        <div class="w-12 h-12 rounded-full overflow-hidden bg-primary/5 flex items-center justify-center shrink-0 border border-outline-variant/20">
                                            @if($member->image_path)
                                                <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                            @else
                                                <x-lucide-user class="w-6 h-6 text-primary" />
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-primary text-lg truncate" title="{{ $member->name }}">{{ $member->name }}</h4>
                                            <p class="text-sm text-secondary tracking-wider uppercase font-semibold mt-1 truncate" title="{{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}">
                                                {{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/5 text-primary uppercase">
                                        @if($member->level === 'commissioner') {{ $locale === 'en' ? 'Commissioner' : 'Komisaris' }}
                                        @elseif($member->level === 'director') {{ $locale === 'en' ? 'Director' : 'Direktur' }}
                                        @elseif($member->level === 'manager') Manager
                                        @else {{ $locale === 'en' ? 'Operational' : 'Operasional' }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif($team)
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

                {{-- Struktur Koperasi TKBM BKJ --}}
                <div class="md:col-span-2 lg:col-span-1">
                    <h2 class="text-headline-md font-bold text-primary mb-8">{{ $locale === 'en' ? 'TKBM Cooperative Structure' : 'Struktur Koperasi Jasa TKBM BKJ' }}</h2>
                    <div class="bg-white p-8 rounded-2xl shadow-ambient border border-outline-variant/30 text-body-lg text-on-surface-variant leading-relaxed h-full">
                        
                        {{-- Pengawas --}}
                        <div class="mb-8">
                            <h3 class="text-label-md text-secondary tracking-widest uppercase mb-4 border-b border-outline-variant/10 pb-2">{{ $locale === 'en' ? 'Supervisors' : 'Pengawas' }}</h3>
                            <ul class="list-disc list-inside space-y-2 font-bold text-primary ml-2">
                                @foreach($koperasiMembers->where('level', 'supervisor') as $member)
                                    <li>{{ $member->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Pengurus --}}
                        <div>
                            <h3 class="text-label-md text-secondary tracking-widest uppercase mb-4 border-b border-outline-variant/10 pb-2">{{ $locale === 'en' ? 'Management Board' : 'Pengurus' }}</h3>
                            <div class="space-y-4">
                                @foreach($koperasiMembers->where('level', 'management') as $member)
                                <div class="flex justify-between items-center {{ !$loop->last ? 'border-b border-outline-variant/10 pb-4' : 'pb-2' }}">
                                    <h4 class="font-bold text-primary text-lg">{{ $member->name }}</h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/5 text-primary uppercase">{{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>
    @endif
</x-public-layout>