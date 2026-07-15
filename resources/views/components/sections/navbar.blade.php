@php
    $navLinks = [
        ['name' => __('messages.home'), 'route' => 'home'],
        ['name' => __('messages.about'), 'route' => 'about'],
        ['name' => __('messages.services'), 'route' => 'services'],
        // Subsidiaries inserted manually
        ['name' => __('messages.gallery'), 'route' => 'gallery'],
        ['name' => __('messages.blog'), 'route' => 'blog'],
        ['name' => __('messages.clients'), 'route' => 'clients'],
    ];

    $subsidiariesLinks = [];
    if (isset($globalSubsidiaries)) {
        foreach ($globalSubsidiaries as $sub) {
            $subsidiariesLinks[] = [
                'name' => $sub['name'],
                'url' => route('subsidiaries.show', $sub['slug']),
                'route_name' => 'subsidiaries.show'
            ];
        }
    }

    $isSubsidiaryActive = request()->routeIs('subsidiaries.*');

    // Dynamic Logo Icon Resolution
    $activeSubsidiary = null;
    if (isset($subsidiary) && $subsidiary instanceof \App\Models\Subsidiary) {
        $activeSubsidiary = $subsidiary;
    } else {
        $route = request()->route();
        if ($route && $route->getName() === 'subsidiaries.show') {
            $slug = $route->parameter('slug');
            $activeSubsidiary = \App\Models\Subsidiary::where('slug', $slug)->first();
        }
    }

    $logoUrl = null;
    if ($activeSubsidiary && $activeSubsidiary->icon_path) {
        $logoUrl = \Illuminate\Support\Facades\Storage::url($activeSubsidiary->icon_path);
    } elseif (!empty($globalSettings['global_icon'])) {
        $logoUrl = \Illuminate\Support\Facades\Storage::url($globalSettings['global_icon']);
    } else {
        $logoUrl = asset('assets/logos/bkj-group-logo-dark.svg');
    }
@endphp

<nav id="navbar" x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 w-full z-[50] bg-white border-b border-outline-variant/30 transition-all duration-300">
    <x-layout.container class="flex items-center justify-between h-20 transition-all duration-300" id="navbar-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ $logoUrl }}" alt="BKJ Group" class="h-10 w-auto object-contain">
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
                             class="absolute top-[80px] left-0 w-64 bg-white border border-outline-variant/30 rounded-xl shadow-ambient overflow-hidden z-50 flex flex-col py-2"
                             style="display: none;">
                            @foreach($subsidiariesLinks as $sub)
                                <a href="{{ $sub['url'] }}" class="px-5 py-3 text-label-md transition-colors {{ request()->url() == $sub['url'] ? 'bg-primary/5 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-primary' }}">
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

    {{-- Mobile Menu (Full Page Overlay) --}}
    <template x-teleport="body">
        <div x-show="mobileMenuOpen"
             x-effect="document.body.classList.toggle('overflow-hidden', mobileMenuOpen)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="lg:hidden fixed inset-0 bg-white z-[99] flex flex-col w-full h-full"
             style="display: none;">
            
            {{-- Mobile Header inside Full Page Overlay --}}
            <div class="h-20 flex items-center justify-between px-6 border-b border-outline-variant/20 shrink-0">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2">
                    <img src="{{ $logoUrl }}" alt="BKJ Group" class="h-10 w-auto object-contain">
                </a>
                <button @click="mobileMenuOpen = false" class="text-primary focus:outline-none p-2 rounded-lg hover:bg-surface-container" aria-label="Close Menu">
                    <x-lucide-x class="w-6 h-6" />
                </button>
            </div>

            {{-- Mobile Scrollable Content --}}
            <div class="flex-grow overflow-y-auto">
                <div class="min-h-full flex flex-col justify-between p-6">
                    {{-- Top links --}}
                    <div class="space-y-1">
                        @foreach($navLinks as $index => $link)
                            @if($index === 3)
                                {{-- Mobile Accordion for Subsidiaries --}}
                                <div x-data="{ accordionOpen: {{ $isSubsidiaryActive ? 'true' : 'false' }} }" class="flex flex-col mb-1">
                                    <button @click="accordionOpen = !accordionOpen" class="flex items-center justify-between py-3.5 px-4 rounded-xl text-label-md transition-colors {{ $isSubsidiaryActive ? 'bg-primary/5 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container' }}">
                                        <span class="text-lg">{{ __('messages.subsidiaries') }}</span>
                                        <x-lucide-chevron-down class="w-5 h-5 transition-transform duration-200" x-bind:class="accordionOpen ? 'rotate-180' : ''" />
                                    </button>
                                    
                                    <div x-show="accordionOpen" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         class="flex flex-col pl-6 pr-4 py-2 space-y-1 border-l-2 border-outline-variant/20 ml-4 mt-1">
                                        @foreach($subsidiariesLinks as $sub)
                                            <a href="{{ $sub['url'] }}" @click="mobileMenuOpen = false" class="py-2.5 px-4 rounded-lg text-label-md transition-colors {{ request()->url() == $sub['url'] ? 'text-primary font-bold bg-primary/5' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container' }}">
                                                {{ $sub['name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <a href="{{ route($link['route']) }}" @click="mobileMenuOpen = false" class="block py-3.5 px-4 rounded-xl text-lg font-medium transition-colors {{ request()->routeIs($link['route']) ? 'bg-primary/5 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-primary' }}">
                                {{ $link['name'] }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Bottom controls --}}
                    <div class="pt-6 border-t border-outline-variant/20 space-y-6">
                        <div class="flex items-center justify-between px-4">
                            <a href="{{ route('search') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 text-primary hover:text-secondary transition-colors py-2">
                                <x-lucide-search class="w-5 h-5" />
                                <span class="text-label-md font-semibold">{{ __('messages.search') }}</span>
                            </a>
                            
                            <div class="flex items-center gap-2">
                                <a href="{{ route('lang.switch', 'id') }}" class="text-label-md px-4 py-1.5 rounded-lg {{ app()->getLocale() === 'id' ? 'bg-secondary text-white font-bold' : 'text-on-surface-variant bg-surface-container' }}">ID</a>
                                <a href="{{ route('lang.switch', 'en') }}" class="text-label-md px-4 py-1.5 rounded-lg {{ app()->getLocale() === 'en' ? 'bg-secondary text-white font-bold' : 'text-on-surface-variant bg-surface-container' }}">EN</a>
                            </div>
                        </div>

                        <div class="px-4 pb-4">
                            <x-ui.button variant="primary" size="lg" class="w-full justify-center text-center font-bold" href="{{ route('contact') }}" @click="mobileMenuOpen = false">
                                {{ __('messages.contact') }}
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</nav>
