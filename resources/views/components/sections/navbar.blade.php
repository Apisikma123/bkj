@php
    $navLinks = [
        ['name' => __('messages.home'), 'route' => 'home'],
        ['name' => __('messages.about'), 'route' => 'about'],
        ['name' => __('messages.services'), 'route' => 'services'],
        // Subsidiaries inserted manually
        ['name' => __('messages.gallery'), 'route' => 'gallery'],
        ['name' => __('messages.blog'), 'route' => 'blog'],
        ['name' => 'Clients', 'route' => 'clients'],
    ];

    $subsidiariesLinks = [];
    foreach (\App\Models\Subsidiary::all() as $sub) {
        $subsidiariesLinks[] = [
            'name' => $sub->name,
            'url' => route('subsidiaries.show', $sub->slug),
            'route_name' => 'subsidiaries.show'
        ];
    }

    $isSubsidiaryActive = request()->routeIs('subsidiaries.*');
@endphp

<nav id="navbar" x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 w-full z-[50] bg-surface/90 backdrop-blur-md border-b border-outline-variant/30 transition-all duration-300">
    <x-layout.container class="flex items-center justify-between h-20 transition-all duration-300" id="navbar-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/logos/bkj-group-logo-dark.svg') }}" alt="BKJ Group" class="h-10 w-auto">
        </a>
        
        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-8 h-full">
            @foreach($navLinks as $index => $link)
                @if($index === 3)
                    {{-- Dropdown Subsidiaries --}}
                    <div x-data="{ dropdownOpen: false }" class="relative h-full flex items-center" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false">
                        <button class="relative h-full flex items-center gap-1 text-label-md transition-colors {{ $isSubsidiaryActive ? 'text-primary font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-secondary' : 'text-on-surface-variant hover:text-primary' }}">
                            {{ __('messages.subsidiaries') }}
                            <x-lucide-chevron-down class="w-4 h-4 transition-transform duration-200" x-bind:class="dropdownOpen ? 'rotate-180' : ''" />
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="dropdownOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-[80px] left-0 w-64 bg-surface/95 backdrop-blur-md border border-outline-variant/30 rounded-xl shadow-ambient overflow-hidden z-50 flex flex-col py-2"
                             style="display: none;">
                            @foreach($subsidiariesLinks as $sub)
                                <a href="{{ $sub['url'] }}" class="px-5 py-3 text-label-md transition-colors {{ request()->url() == $sub['url'] ? 'bg-primary/5 text-primary font-bold border-l-4 border-secondary' : 'text-on-surface-variant hover:bg-surface-container hover:text-primary border-l-4 border-transparent' }}">
                                    {{ $sub['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="{{ route($link['route']) }}" class="relative h-full flex items-center text-label-md transition-colors {{ request()->routeIs($link['route']) ? 'text-primary font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-secondary' : 'text-on-surface-variant hover:text-primary' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach
            
            <div class="flex items-center gap-4 ml-4">
                <a href="{{ route('search') }}" class="text-primary hover:text-secondary transition-colors" aria-label="{{ __('messages.search') }}">
                    <x-lucide-search class="w-5 h-5" />
                </a>
                
                <div class="flex items-center gap-2 border-l border-outline-variant/30 pl-4">
                    <a href="{{ route('lang.switch', 'id') }}" class="text-label-md {{ app()->getLocale() === 'id' ? 'text-secondary font-bold' : 'text-on-surface-variant hover:text-primary' }}">ID</a>
                    <span class="text-outline-variant">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="text-label-md {{ app()->getLocale() === 'en' ? 'text-secondary font-bold' : 'text-on-surface-variant hover:text-primary' }}">EN</a>
                </div>
            </div>

            <x-ui.button variant="primary" size="sm" href="{{ route('contact') }}">
                {{ __('messages.contact') }}
            </x-ui.button>
        </div>
        
        {{-- Mobile Menu Toggle --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-primary focus:outline-none" aria-label="Toggle Menu">
            <x-lucide-menu x-show="!mobileMenuOpen" class="w-6 h-6" />
            <x-lucide-x x-show="mobileMenuOpen" class="w-6 h-6" style="display: none;" />
        </button>
    </x-layout.container>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden absolute top-20 left-0 w-full bg-white border-b border-outline-variant/30 shadow-ambient flex flex-col"
         style="display: none;">
        
        <div class="flex flex-col p-6 space-y-1 overflow-y-auto max-h-[calc(100vh-80px)]">
            @foreach($navLinks as $index => $link)
                @if($index === 3)
                    {{-- Mobile Accordion for Subsidiaries --}}
                    <div x-data="{ accordionOpen: {{ $isSubsidiaryActive ? 'true' : 'false' }} }" class="flex flex-col mb-1">
                        <button @click="accordionOpen = !accordionOpen" class="flex items-center justify-between py-3 px-4 rounded-lg text-label-md transition-colors {{ $isSubsidiaryActive ? 'bg-primary/5 text-primary font-bold border-l-4 border-secondary' : 'text-on-surface-variant' }}">
                            <span>{{ __('messages.subsidiaries') }}</span>
                            <x-lucide-chevron-down class="w-4 h-4 transition-transform duration-200" x-bind:class="accordionOpen ? 'rotate-180' : ''" />
                        </button>
                        
                        <div x-show="accordionOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             class="flex flex-col pl-6 pr-4 py-2 space-y-1 border-l-2 border-outline-variant/20 ml-2 mt-1">
                            @foreach($subsidiariesLinks as $sub)
                                <a href="{{ $sub['url'] }}" class="py-2 px-4 rounded-lg text-label-md transition-colors {{ request()->url() == $sub['url'] ? 'text-primary font-bold bg-primary/5 border-l-4 border-secondary -ml-[18px] pl-[14px]' : 'text-on-surface-variant hover:text-primary' }}">
                                    {{ $sub['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="{{ route($link['route']) }}" class="block py-3 px-4 rounded-lg text-label-md transition-colors {{ request()->routeIs($link['route']) ? 'bg-primary/5 text-primary font-bold border-l-4 border-secondary' : 'text-on-surface-variant hover:bg-surface-container hover:text-primary' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach

            <div class="pt-6 mt-4 border-t border-outline-variant/30 flex items-center justify-between px-4">
                <a href="{{ route('search') }}" class="flex items-center gap-2 text-primary hover:text-secondary transition-colors">
                    <x-lucide-search class="w-5 h-5" />
                    <span class="text-label-md">{{ __('messages.search') }}</span>
                </a>
                
                <div class="flex items-center gap-2">
                    <a href="{{ route('lang.switch', 'id') }}" class="text-label-md px-3 py-1 rounded-md {{ app()->getLocale() === 'id' ? 'bg-secondary text-white font-bold' : 'text-on-surface-variant bg-surface-container' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="text-label-md px-3 py-1 rounded-md {{ app()->getLocale() === 'en' ? 'bg-secondary text-white font-bold' : 'text-on-surface-variant bg-surface-container' }}">EN</a>
                </div>
            </div>

            <div class="pt-6 px-4">
                <x-ui.button variant="primary" class="w-full justify-center" href="{{ route('contact') }}">
                    {{ __('messages.contact') }}
                </x-ui.button>
            </div>
        </div>
    </div>
</nav>
