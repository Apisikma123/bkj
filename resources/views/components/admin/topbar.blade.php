<header class="h-16 bg-white border-b border-outline-variant/20 flex items-center justify-between px-4 md:px-8 shadow-sm z-10 sticky top-0">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="text-on-surface-variant hover:text-primary transition-colors focus:outline-none p-2 rounded-lg hover:bg-surface-container">
            <x-lucide-menu class="w-5 h-5" />
        </button>
    </div>

    <div class="flex items-center gap-2 md:gap-4">
        {{-- Help Guide Trigger --}}
        <x-admin.help />

        <!-- Profile -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none p-1 pr-2 rounded-full hover:bg-surface-container transition-colors">
                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm border border-outline-variant/20">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-xs font-bold text-primary">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-[10px] text-on-surface-variant -mt-0.5">Super Admin</span>
                </div>
                <x-lucide-chevron-down class="w-4 h-4 text-outline" />
            </button>
            
            <div x-show="open" @click.away="open = false" style="display: none;" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-hover border border-outline-variant/20 py-1 overflow-hidden z-50">
                <div class="px-4 py-2 border-b border-outline-variant/10">
                    <p class="text-xs text-outline">Signed in as</p>
                    <p class="text-sm font-semibold text-primary truncate">{{ Auth::user()->email ?? 'admin@bkjgroup.com' }}</p>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors">
                    <x-lucide-external-link class="w-4 h-4" /> View Site
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors">
                    <x-lucide-user class="w-4 h-4" /> Profile Settings
                </a>
                <div class="h-px bg-outline-variant/10 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-error hover:bg-error-container hover:text-error transition-colors">
                        <x-lucide-log-out class="w-4 h-4" /> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
