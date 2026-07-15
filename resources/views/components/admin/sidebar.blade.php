<aside class="fixed lg:relative lg:flex w-64 h-full bg-primary/95 backdrop-blur-xl border-r border-white/10 text-white flex-shrink-0 transition-all duration-300 flex flex-col shadow-ambient z-40" 
       :class="{ '-ml-64 lg:ml-0 lg:w-0 lg:overflow-hidden lg:border-none': !sidebarOpen }">
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
                ['label' => 'Favicon & Icons', 'route' => 'admin.company-assets.index', 'icon' => 'palette', 'active' => 'admin.company-assets.*'],
                ['label' => 'News Center', 'route' => 'admin.blogs.index', 'icon' => 'newspaper', 'active' => 'admin.blogs.*'],
                ['label' => 'Gallery', 'route' => 'admin.galleries.index', 'icon' => 'image', 'active' => ['admin.galleries.*']],
                ['label' => 'Layanan', 'route' => 'admin.services.index', 'icon' => 'truck', 'active' => 'admin.services.*'],
                ['label' => 'Struktur Tim', 'route' => 'admin.team-members.index', 'icon' => 'users-2', 'active' => 'admin.team-members.*'],
                ['label' => 'Daftar Klien', 'route' => 'admin.clients.index', 'icon' => 'award', 'active' => 'admin.clients.*'],
                ['label' => 'Rekening Bank', 'route' => 'admin.bank-accounts.index', 'icon' => 'credit-card', 'active' => 'admin.bank-accounts.*'],
                ['label' => 'Inbox', 'route' => 'admin.contacts.index', 'icon' => 'mail', 'active' => 'admin.contacts.*'],
            ];

            if (auth()->check() && auth()->user()->role && auth()->user()->role->slug === 'super-admin') {
                $menus[] = ['label' => 'User Management', 'route' => 'admin.users.index', 'icon' => 'user-cog', 'active' => 'admin.users.*'];
            }
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
