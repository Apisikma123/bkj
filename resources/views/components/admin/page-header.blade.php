@props(['title', 'actionText' => null, 'actionRoute' => null, 'icon' => null])

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        @if($icon)
            <div class="w-10 h-10 rounded-md bg-white border border-outline-variant/30 flex items-center justify-center text-primary shadow-sm">
                @svg("lucide-$icon", 'w-5 h-5')
            </div>
        @endif
        <h1 class="text-headline-md font-bold text-primary">{{ $title }}</h1>
    </div>
    
    @if($actionText && $actionRoute)
        <a href="{{ $actionRoute }}" class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-container transition-colors font-medium text-sm shadow-sm">
            <x-lucide-plus class="w-4 h-4 mr-2" />
            {{ $actionText }}
        </a>
    @endif
</div>
