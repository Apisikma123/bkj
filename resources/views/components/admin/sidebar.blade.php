<aside class="w-64 h-full bg-primary/95 backdrop-blur-xl border-r border-white/10 text-white flex-shrink-0 transition-all duration-300 flex flex-col shadow-ambient z-20 relative" :class="{ '-ml-64': !sidebarOpen }">
    <div class="h-16 flex items-center justify-between px-6 border-b border-white/10">
        <div class="flex items-center gap-2">
            <x-lucide-box class="w-6 h-6 text-accent" />
            <span class="text-xl font-bold tracking-wide text-white">BKJ <span class="text-white/70 font-medium">CMS</span></span>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden text-white/50 hover:text-white transition-colors">
            <x-lucide-x class="w-5 h-5" />
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 custom-scrollbar">
        @php
            $menus = [
                ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'layout-dashboard', 'active' => 'admin.dashboard'],
                ['label' => 'Website Content', 'route' => 'admin.content.index', 'icon' => 'file-text', 'active' => 'admin.content.*'],
                ['label' => 'News Center', 'route' => 'admin.blogs.index', 'icon' => 'newspaper', 'active' => 'admin.blogs.*'],
                ['label' => 'Gallery', 'route' => 'admin.galleries.index', 'icon' => 'image', 'active' => ['admin.galleries.*']],
                ['label' => 'Inbox', 'route' => 'admin.contacts.index', 'icon' => 'mail', 'active' => 'admin.contacts.*'],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}" 
               class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-300 font-medium text-sm relative overflow-hidden
                      {{ request()->routeIs($menu['active']) ? 'text-white bg-white/10 shadow-sm' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                @if(request()->routeIs($menu['active']))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-secondary rounded-r-full"></div>
                @endif
                <div class="{{ request()->routeIs($menu['active']) ? 'text-secondary' : 'text-white/50 group-hover:text-white/80 transition-colors' }}">
                    @svg("lucide-{$menu['icon']}", 'w-5 h-5')
                </div>
                {{ $menu['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
