<x-public-layout>
    @php
        $locale = app()->getLocale();
        $subName = $locale === 'en' && !empty($subsidiary->name_en) ? $subsidiary->name_en : $subsidiary->name;
        $subDesc = $locale === 'en' && !empty($subsidiary->description_en) ? $subsidiary->description_en : ($subsidiary->description ?? ($locale === 'en' ? 'Subsidiary of PT. BATAM KEPRI JAYA' : 'Anak Perusahaan PT. BATAM KEPRI JAYA'));
        $subContent = $locale === 'en' && !empty($subsidiary->content_en) ? $subsidiary->content_en : $subsidiary->content;
    @endphp

    <x-slot:title>{{ $subName }}</x-slot>

    {{-- Hero Section --}}
    <x-sections.hero 
        title="{{ $subName }}"
        subtitle="{{ $subDesc }}"
        image="{{ $subsidiary->hero_image ? Storage::url($subsidiary->hero_image) : '' }}"
        primaryCta="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        primaryLink="{{ route('contact') }}"
    />

    {{-- Content Section --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="prose prose-lg max-w-4xl mx-auto">
                {!! $subContent !!}
            </div>
            
            @if(empty($subContent))
            <div class="text-center py-12">
                <p class="text-body-lg text-on-surface-variant italic">{{ $locale === 'en' ? 'No content available for this subsidiary yet.' : 'Belum ada konten untuk anak perusahaan ini.' }}</p>
            </div>
            @endif
        </x-layout.container>
    </section>

    {{-- Team Section (Dynamic based on subsidiary slug) --}}
    @if(isset($teamMembers) && $teamMembers->count() > 0)
    <section class="py-12 md:py-24 bg-surface-container-lowest border-t border-outline-variant/30" data-scroll-reveal>
        <x-layout.container>
            <div class="max-w-4xl mx-auto">
                <h2 class="text-headline-md font-bold text-primary mb-8 text-center">{{ $locale === 'en' ? 'Our Team' : 'Struktur Organisasi & Tim' }}</h2>
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
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/5 text-primary uppercase whitespace-nowrap">
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
        </x-layout.container>
    </section>
    @endif

    {{-- CTA Banner --}}
    <x-sections.cta-banner 
        title="{{ $locale === 'en' ? 'Ready to Optimize Your Business?' : 'Siap Mengoptimalkan Bisnis Anda?' }}" 
        description="{{ $locale === 'en' ? 'Consult your needs with our professional team.' : 'Konsultasikan kebutuhan Anda bersama tim profesional kami.' }}"
        buttonText="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        buttonLink="{{ route('contact') }}"
    />
</x-public-layout>
