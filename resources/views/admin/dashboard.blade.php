<x-admin-layout>
    <div class="space-y-6">
        <x-admin.page-header title="Dashboard Overview" subtitle="Welcome back! Here is what's happening today." />
        <!-- Statistik Ringkasan -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-surface-container shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                    <x-lucide-newspaper class="w-6 h-6"/>
                </div>
                <div>
                    <span class="text-sm font-medium text-outline block">Total Berita</span>
                    <span class="text-2xl font-bold text-on-surface">{{ $totalBlogs }}</span>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-surface-container shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
                    <x-lucide-image class="w-6 h-6"/>
                </div>
                <div>
                    <span class="text-sm font-medium text-outline block">Total Galeri</span>
                    <span class="text-2xl font-bold text-on-surface">{{ $totalGalleries }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-surface-container shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                    <x-lucide-truck class="w-6 h-6"/>
                </div>
                <div>
                    <span class="text-sm font-medium text-outline block">Total Layanan</span>
                    <span class="text-2xl font-bold text-on-surface">{{ $totalServices }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-surface-container shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                    <x-lucide-mail class="w-6 h-6"/>
                </div>
                <div>
                    <span class="text-sm font-medium text-outline block">Pesan Baru</span>
                    <span class="text-2xl font-bold text-on-surface">{{ $unreadMessagesCount }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-container p-6">
            <h3 class="font-semibold text-on-surface mb-4 flex items-center gap-2">
                <x-lucide-zap class="w-5 h-5 text-amber-500"/> Quick Actions
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
                <a href="{{ route('admin.content.index') }}" class="group p-4 rounded-xl border border-surface-container bg-surface-container-low hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center flex flex-col justify-between">
                    <div class="w-10 h-10 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-layout-template class="w-5 h-5"/>
                    </div>
                    <span class="text-xs font-semibold text-on-surface-variant group-hover:text-primary">Edit Web Content</span>
                </a>
                
                <a href="{{ route('admin.blogs.create') }}" class="group p-4 rounded-xl border border-surface-container bg-surface-container-low hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center flex flex-col justify-between">
                    <div class="w-10 h-10 mx-auto rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-pen-tool class="w-5 h-5"/>
                    </div>
                    <span class="text-xs font-semibold text-on-surface-variant group-hover:text-primary">Write News</span>
                </a>

                <a href="{{ route('admin.galleries.create') }}" class="group p-4 rounded-xl border border-surface-container bg-surface-container-low hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center flex flex-col justify-between">
                    <div class="w-10 h-10 mx-auto rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-image-plus class="w-5 h-5"/>
                    </div>
                    <span class="text-xs font-semibold text-on-surface-variant group-hover:text-primary">Upload Gallery</span>
                </a>

                <a href="{{ route('admin.services.create') }}" class="group p-4 rounded-xl border border-surface-container bg-surface-container-low hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center flex flex-col justify-between">
                    <div class="w-10 h-10 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-truck class="w-5 h-5"/>
                    </div>
                    <span class="text-xs font-semibold text-on-surface-variant group-hover:text-primary">Tambah Layanan</span>
                </a>

                <a href="{{ route('admin.clients.create') }}" class="group p-4 rounded-xl border border-surface-container bg-surface-container-low hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center flex flex-col justify-between">
                    <div class="w-10 h-10 mx-auto rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-award class="w-5 h-5"/>
                    </div>
                    <span class="text-xs font-semibold text-on-surface-variant group-hover:text-primary">Tambah Klien</span>
                </a>
            </div>
        </div>

        <!-- Monitoring Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Recent Inbox Messages -->
            <div class="bg-white rounded-2xl shadow-sm border border-surface-container overflow-hidden">
                <div class="px-6 py-4 border-b border-surface-container flex items-center justify-between bg-surface-container-low/50">
                    <h3 class="font-semibold text-on-surface flex items-center gap-2">
                        <x-lucide-inbox class="w-5 h-5 text-outline" />
                        Recent Inbox
                    </h3>
                    <a href="{{ route('admin.contacts.index') }}" class="text-xs text-primary hover:underline">View All</a>
                </div>
                <div class="divide-y divide-surface-container-low">
                    @forelse($recentMessages as $msg)
                        <div class="p-4 flex gap-4 hover:bg-surface-container-low transition-colors {{ !$msg->is_read ? 'bg-blue-50/30' : '' }}">
                            <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-outline shrink-0 font-bold">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="text-sm font-medium text-on-surface truncate {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</h4>
                                    <span class="text-xs text-outline">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-outline truncate">{{ Str::limit($msg->message, 60) }}</p>
                            </div>
                            <a href="{{ route('admin.contacts.show', $msg) }}" class="shrink-0 flex items-center text-primary hover:text-primary-dark">
                                <x-lucide-chevron-right class="w-5 h-5" />
                            </a>
                        </div>
                    @empty
                        <div class="p-8 text-center text-outline">
                            <x-lucide-inbox class="w-10 h-10 mx-auto text-outline-variant mb-3" />
                            <p class="text-sm">No recent messages.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent News Updates -->
            <div class="bg-white rounded-2xl shadow-sm border border-surface-container overflow-hidden">
                <div class="px-6 py-4 border-b border-surface-container flex items-center justify-between bg-surface-container-low/50">
                    <h3 class="font-semibold text-on-surface flex items-center gap-2">
                        <x-lucide-newspaper class="w-5 h-5 text-outline" />
                        Recent News Updates
                    </h3>
                    <a href="{{ route('admin.blogs.index') }}" class="text-xs text-primary hover:underline">Manage News</a>
                </div>
                <div class="divide-y divide-surface-container-low">
                    @forelse($recentNews as $news)
                        <div class="p-4 flex items-start gap-4 hover:bg-surface-container-low transition-colors">
                            @if(!empty($news->thumbnail))
                                <img src="{{ Storage::url($news->thumbnail) }}" class="w-16 h-12 rounded-lg object-cover border border-surface-container-highest">
                            @else
                                <div class="w-16 h-12 rounded-lg bg-surface-container flex items-center justify-center text-outline border border-surface-container-highest">
                                    <x-lucide-file-text class="w-5 h-5"/>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-on-surface mb-1 truncate">{{ $news->title }}</h4>
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="text-outline">{{ $news->created_at->format('d M Y') }}</span>
                                    <span class="px-2 py-0.5 rounded-full {{ $news->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($news->status) }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-outline">
                            <x-lucide-file-text class="w-10 h-10 mx-auto text-outline-variant mb-3" />
                            <p class="text-sm">No recent news.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Latest Gallery Uploads -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-container overflow-hidden">
            <div class="px-6 py-4 border-b border-surface-container flex items-center justify-between">
                <h3 class="font-semibold text-on-surface flex items-center gap-2">
                    <x-lucide-image class="w-5 h-5 text-outline" />
                    Latest Gallery Uploads
                </h3>
                <a href="{{ route('admin.galleries.index') }}" class="text-xs text-primary hover:underline">View All</a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($latestGallery as $item)
                        <div class="aspect-square rounded-xl overflow-hidden bg-surface-container relative group border border-surface-container-highest shadow-sm">
                            @if(!empty($item->image_path))
                                <img src="{{ Storage::url($item->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-outline-variant/10"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                                <p class="text-white text-xs font-medium truncate">{{ $item->title }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-8 text-center text-outline">
                            <x-lucide-image-off class="w-10 h-10 mx-auto text-outline-variant mb-3" />
                            <p class="text-sm">No gallery items found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
