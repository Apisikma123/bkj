<x-admin-layout>
    <div class="space-y-6">
        <x-admin.page-header title="Dashboard Overview" subtitle="Welcome back! Here is what's happening today." />

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <x-lucide-zap class="w-5 h-5 text-amber-500"/> Quick Actions
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('admin.content.index') }}" class="group p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center">
                    <div class="w-10 h-10 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-layout-template class="w-5 h-5"/>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-primary">Edit Web Content</span>
                </a>
                
                <a href="{{ route('admin.blogs.create') }}" class="group p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center">
                    <div class="w-10 h-10 mx-auto rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-pen-tool class="w-5 h-5"/>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-primary">Write News</span>
                </a>

                <a href="{{ route('admin.galleries.create') }}" class="group p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-sm hover:border-primary/20 transition-all text-center">
                    <div class="w-10 h-10 mx-auto rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <x-lucide-image-plus class="w-5 h-5"/>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-primary">Upload Gallery</span>
                </a>
            </div>
        </div>

        <!-- Monitoring Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Recent Inbox Messages -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-semibold text-gray-900 flex items-center gap-2">
                        <x-lucide-inbox class="w-5 h-5 text-gray-500" />
                        Recent Inbox
                    </h3>
                    <a href="{{ route('admin.contacts.index') }}" class="text-xs text-primary hover:underline">View All</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($recentMessages as $msg)
                        <div class="p-4 flex gap-4 hover:bg-gray-50 transition-colors {{ !$msg->is_read ? 'bg-blue-50/30' : '' }}">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 shrink-0 font-bold">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="text-sm font-medium text-gray-900 truncate {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</h4>
                                    <span class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate">{{ Str::limit($msg->message, 60) }}</p>
                            </div>
                            <a href="{{ route('admin.contacts.show', $msg) }}" class="shrink-0 flex items-center text-primary hover:text-primary-dark">
                                <x-lucide-chevron-right class="w-5 h-5" />
                            </a>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            <x-lucide-inbox class="w-10 h-10 mx-auto text-gray-300 mb-3" />
                            <p class="text-sm">No recent messages.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent News Updates -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-semibold text-gray-900 flex items-center gap-2">
                        <x-lucide-newspaper class="w-5 h-5 text-gray-500" />
                        Recent News Updates
                    </h3>
                    <a href="{{ route('admin.blogs.index') }}" class="text-xs text-primary hover:underline">Manage News</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($recentNews as $news)
                        <div class="p-4 flex items-start gap-4 hover:bg-gray-50 transition-colors">
                            @if(!empty($news->thumbnail))
                                <img src="{{ Storage::url($news->thumbnail) }}" class="w-16 h-12 rounded-lg object-cover border border-gray-200">
                            @else
                                <div class="w-16 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                    <x-lucide-file-text class="w-5 h-5"/>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 mb-1 truncate">{{ $news->title }}</h4>
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="text-gray-500">{{ $news->created_at->format('d M Y') }}</span>
                                    <span class="px-2 py-0.5 rounded-full {{ $news->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($news->status) }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            <x-lucide-file-text class="w-10 h-10 mx-auto text-gray-300 mb-3" />
                            <p class="text-sm">No recent news.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Latest Gallery Uploads -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-semibold text-gray-900 flex items-center gap-2">
                    <x-lucide-image class="w-5 h-5 text-gray-500" />
                    Latest Gallery Uploads
                </h3>
                <a href="{{ route('admin.galleries.index') }}" class="text-xs text-primary hover:underline">View All</a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($latestGallery as $item)
                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 relative group border border-gray-200 shadow-sm">
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
                        <div class="col-span-full py-8 text-center text-gray-500">
                            <x-lucide-image-off class="w-10 h-10 mx-auto text-gray-300 mb-3" />
                            <p class="text-sm">No gallery items found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
