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

    {{-- CTA Banner --}}
    <x-sections.cta-banner 
        title="{{ $locale === 'en' ? 'Ready to Optimize Your Business?' : 'Siap Mengoptimalkan Bisnis Anda?' }}" 
        description="{{ $locale === 'en' ? 'Consult your needs with our professional team.' : 'Konsultasikan kebutuhan Anda bersama tim profesional kami.' }}"
        buttonText="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        buttonLink="{{ route('contact') }}"
    />
</x-public-layout>
