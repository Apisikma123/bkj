@props(['subtitle' => null, 'title', 'alignment' => 'left', 'light' => false])

@php
    $alignClass = match($alignment) {
        'center' => 'text-center items-center',
        'right' => 'text-right items-end',
        default => 'text-left items-start',
    };
    
    $titleColor = $light ? 'text-white' : 'text-primary';
    $subtitleColor = $light ? 'text-secondary-container' : 'text-secondary';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col gap-2 mb-12 $alignClass"]) }} data-scroll-reveal>
    @if($subtitle)
        <span class="text-label-md uppercase tracking-wider font-semibold {{ $subtitleColor }}">
            {{ $subtitle }}
        </span>
    @endif
    
    <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold {{ $titleColor }}">
        {{ $title }}
    </h2>
    
    @if($slot->isNotEmpty())
        <div class="mt-4 text-body-lg {{ $light ? 'text-surface-dim' : 'text-on-surface-variant' }} max-w-2xl">
            {{ $slot }}
        </div>
    @endif
</div>
