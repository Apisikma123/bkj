@props([
    'title',
    'subtitle' => null,
    'image',
    'primaryCta' => null,
    'primaryLink' => '#',
    'secondaryCta' => null
])

@php
    $locale = app()->getLocale();
    $secondaryCta = $secondaryCta ?? ($locale === 'en' ? 'Learn More' : 'Pelajari Lebih Lanjut');
@endphp

<div class="relative w-full h-screen min-h-[600px] flex items-center overflow-x-hidden bg-primary" id="hero">
    {{-- Parallax Background --}}
    <div class="absolute inset-0 w-full h-[120%] -top-[10%] z-0" data-hero-parallax>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/70 to-transparent z-10"></div>
        @if(!empty($image) && !str_contains($image, 'assets/images/'))
            <x-ui.image src="{{ $image }}" alt="{{ $title }}" :priority="true" />
        @else
            <div class="w-full h-full bg-outline-variant/10"></div>
        @endif
    </div>
    
    <x-layout.container class="relative z-10 pt-20">
        <div class="max-w-3xl flex flex-col gap-6">
            @if($subtitle)
                <div class="overflow-hidden">
                    <span class="block text-secondary-container font-semibold tracking-widest uppercase text-label-md" data-hero-text>
                        {{ $subtitle }}
                    </span>
                </div>
            @endif
            
            <div class="overflow-hidden">
                <h1 class="text-display-lg text-white font-bold" data-hero-text>
                    {{ $title }}
                </h1>
            </div>
            
            <div class="flex flex-wrap gap-4 mt-4" data-hero-text>
                @if($primaryCta)
                    <x-ui.button variant="primary" href="{{ $primaryLink }}" size="lg">
                        {{ $primaryCta }}
                    </x-ui.button>
                @endif
                <x-ui.button variant="tertiary" href="/contact" size="lg" class="!text-white after:!bg-white">
                    {{ $secondaryCta }}
                </x-ui.button>
            </div>
        </div>
    </x-layout.container>
    
    {{-- Scroll Indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/50 cursor-pointer hover:text-white transition-colors duration-300">
        <span class="text-xs font-semibold uppercase tracking-widest">Scroll</span>
        <x-lucide-mouse class="w-5 h-5" />
    </div>
</div>
