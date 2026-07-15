@props(['title', 'description', 'buttonText', 'buttonLink' => '/contact'])

<section class="py-12 md:py-24 relative overflow-hidden bg-primary" data-scroll-reveal>
    {{-- Decorative Background Patterns --}}
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-primary-container/50 to-transparent skew-x-12 translate-x-1/4"></div>
    
    <x-layout.container class="relative z-10 text-center">
        <div class="max-w-3xl mx-auto flex flex-col items-center gap-6">
            <h2 class="text-headline-lg text-white font-bold">{{ $title }}</h2>
            <p class="text-body-lg text-on-primary-container">{{ $description }}</p>
            
            <div class="mt-4">
                <x-ui.button variant="primary" size="lg" href="{{ $buttonLink }}">
                    {{ $buttonText }}
                    <x-lucide-arrow-right class="w-5 h-5 ml-2" />
                </x-ui.button>
            </div>
        </div>
    </x-layout.container>
</section>
