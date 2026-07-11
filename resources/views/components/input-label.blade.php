@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-on-surface mb-2']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-error ml-1">*</span>
    @endif
</label>
