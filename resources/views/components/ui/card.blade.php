@props(['title' => null, 'description' => null, 'icon' => null, 'interactive' => false, 'headerBorder' => null])

@php
    $baseClasses = 'bg-white rounded-DEFAULT border border-outline-variant shadow-ambient flex flex-col overflow-hidden';
    
    if ($interactive) {
        $baseClasses .= ' transition-all duration-300 hover:shadow-hover hover:-translate-y-1 hover:scale-[1.01]';
    }
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    @if($headerBorder)
        <div class="h-1 w-full bg-{{ $headerBorder }}"></div>
    @endif
    
    <div class="p-6 flex flex-col h-full gap-4">
        @if($icon)
            <div class="w-12 h-12 flex items-center justify-center bg-surface-container rounded-md text-primary">
                {{ $icon }}
            </div>
        @endif
        
        @if($title || $description)
            <div class="flex flex-col gap-2">
                @if($title)
                    <h3 class="text-headline-md text-primary">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="text-body-md text-on-surface-variant">{{ $description }}</p>
                @endif
            </div>
        @endif
        
        <div class="mt-auto flex-grow">
            {{ $slot }}
        </div>
    </div>
</div>
