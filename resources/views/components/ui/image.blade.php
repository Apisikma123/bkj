@props(['src', 'alt' => '', 'lazy' => true, 'priority' => false, 'class' => '', 'width' => null, 'height' => null])

@php
    $loading = $priority ? 'eager' : ($lazy ? 'lazy' : 'auto');
    $fetchpriority = $priority ? 'high' : 'auto';
    $decoding = $priority ? 'sync' : 'async';
    $opacityClass = $priority ? 'opacity-100' : 'opacity-0';
@endphp

<picture class="block {{ $class }}">
    <img 
        src="{{ $src }}" 
        alt="{{ $alt }}" 
        loading="{{ $loading }}" 
        fetchpriority="{{ $fetchpriority }}"
        decoding="{{ $decoding }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        {{ $attributes->merge(['class' => 'w-full h-full object-cover transition-opacity duration-normal']) }}
        @if(!$priority) onload="this.classList.add('opacity-100'); this.classList.remove('opacity-0');" @endif
        class="{{ $opacityClass }} w-full h-full object-cover transition-opacity duration-normal"
    >
</picture>
