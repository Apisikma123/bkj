@props(['member', 'locale' => 'id'])

<div class="bg-gradient-to-b from-white to-surface-container-low rounded-2xl p-4 md:p-6 w-full max-w-[288px] text-center border border-outline-variant/30 shadow-ambient flex flex-col items-center group hover:-translate-y-2 hover:shadow-hover hover:border-secondary/50 transition-all duration-500 relative z-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-secondary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    
    <div class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-white mb-4 md:mb-5 overflow-hidden relative border-4 border-surface shadow-sm group-hover:border-secondary/30 transition-colors duration-500 z-10 flex-shrink-0">
        @if($member->image_path)
            <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
        @else
            <div class="absolute inset-0 flex items-center justify-center text-primary group-hover:bg-gradient-to-br group-hover:from-secondary group-hover:to-primary group-hover:text-white transition-all duration-500">
                <x-lucide-user class="w-8 h-8 md:w-10 md:h-10" />
            </div>
        @endif
    </div>
    <div class="relative z-10">
        <h3 class="text-body-lg md:text-headline-sm font-display font-bold text-primary mb-1 line-clamp-2" title="{{ $member->name }}">{{ $member->name }}</h3>
        <div class="inline-block px-3 md:px-4 py-1 bg-primary/5 rounded-full mt-2 border border-primary/10">
            <p class="text-[10px] md:text-label-md text-secondary tracking-widest uppercase font-bold break-words">{{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}</p>
        </div>
    </div>
</div>
