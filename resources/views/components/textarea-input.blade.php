@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-2.5 bg-surface-container-low border border-outline-variant/40 text-on-surface text-sm rounded-DEFAULT focus:ring-[3px] focus:ring-secondary/20 focus:border-secondary block w-full transition-all duration-200 shadow-sm disabled:bg-surface-container-lowest disabled:text-outline disabled:border-outline-variant/20']) }}>{{ $slot }}</textarea>
