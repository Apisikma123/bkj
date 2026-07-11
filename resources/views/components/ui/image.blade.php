@props(['src', 'alt' => '', 'lazy' => true, 'priority' => false, 'class' => ''])

@php
    $loading = $priority ? 'eager' : ($lazy ? 'lazy' : 'auto');
    $fetchpriority = $priority ? 'high' : 'auto';
    $decoding = 'async';
@endphp

<picture class="block {{ $class }}">
    <img 
        src="{{ $src }}" 
        alt="{{ $alt }}" 
        loading="{{ $loading }}" 
        fetchpriority="{{ $fetchpriority }}"
        decoding="{{ $decoding }}"
        {{ $attributes->merge(['class' => 'w-full h-full object-cover transition-opacity duration-normal']) }}
        onload="this.classList.add('opacity-100'); this.classList.remove('opacity-0');"
        class="opacity-0 w-full h-full object-cover transition-opacity duration-normal"
    >
</picture>
