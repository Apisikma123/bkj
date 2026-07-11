@props(['disabled' => false])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-2.5 bg-white border border-outline-variant/40 text-on-surface text-sm rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary block w-full transition-all duration-200 shadow-sm disabled:bg-surface-container-lowest disabled:text-outline disabled:border-outline-variant/20']) }}>
    {{ $slot }}
</select>
