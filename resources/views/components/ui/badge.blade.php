@props(['variant' => 'primary'])

@php
    $variants = [
        'primary' => 'bg-primary-container text-on-primary-container',
        'secondary' => 'bg-secondary-container text-on-secondary-container',
        'tertiary' => 'bg-tertiary-container text-on-tertiary-container',
        'outline' => 'border border-outline text-on-surface-variant',
    ];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider {$variants[$variant]}"]) }}>
    {{ $slot }}
</span>
