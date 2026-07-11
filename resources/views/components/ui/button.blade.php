@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button'
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-DEFAULT transition-all duration-fast magnetic-btn focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $variants = [
        'primary' => 'bg-secondary text-white hover:bg-secondary-container hover:shadow-hover hover:scale-[1.02] active:scale-95 focus:ring-secondary',
        'secondary' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white active:scale-95 focus:ring-primary',
        'tertiary' => 'text-primary hover:text-primary-container active:scale-95 relative after:content-[""] after:absolute after:w-full after:scale-x-0 after:h-[2px] after:bottom-0 after:left-0 after:bg-primary after:origin-center after:transition-transform after:duration-fast hover:after:scale-x-100 focus:ring-primary',
        'error' => 'bg-error text-white hover:bg-error-container hover:text-on-error-container hover:shadow-hover hover:scale-[1.02] active:scale-95 focus:ring-error',
    ];
    
    $sizes = [
        'sm' => 'px-4 py-2 text-label-md',
        'md' => 'px-6 py-3 text-body-md',
        'lg' => 'px-8 py-4 text-body-lg',
    ];
    
    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
