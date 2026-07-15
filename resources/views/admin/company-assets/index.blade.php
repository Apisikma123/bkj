<x-admin-layout>
    <div class="space-y-6" x-data="{ activeTab: 'global' }">
        <x-admin.page-header title="Company Icons & Favicons" subtitle="Manage logo icons and tab favicons dynamically for each subsidiary company and global pages." icon="image" />

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Tabs Header -->
            <div class="flex overflow-x-auto border-b border-gray-100 custom-scrollbar bg-gray-50/50">
                <button @click="activeTab = 'global'"
                        class="px-6 py-4 text-sm font-medium transition-colors border-b-2 whitespace-nowrap"
                        :class="activeTab === 'global' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                    BKJ Group (All Pages)
                </button>
                @foreach($subsidiaries as $sub)
                    <button @click="activeTab = '{{ $sub->slug }}'"
                            class="px-6 py-4 text-sm font-medium transition-colors border-b-2 whitespace-nowrap"
                            :class="activeTab === '{{ $sub->slug }}' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'">
                        {{ $sub->name }}
                    </button>
                @endforeach
            </div>

            <!-- Tabs Content -->
            <div class="p-6">
                <!-- Global (All Pages) Tab -->
                <div x-show="activeTab === 'global'" x-cloak class="space-y-6">
                    <form action="{{ route('admin.company-assets.update-global') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Global Icon Card -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                                <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                        <x-lucide-image class="w-5 h-5 text-secondary" /> Global Logo / Icon
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">This icon represents the brand logo inside public sections and pages of all general pages.</p>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                                    <!-- Preview -->
                                    <div class="flex flex-col items-center justify-center p-4 bg-gray-50 border border-dashed border-gray-200 rounded-xl h-44">
                                        @if(!empty($globalSettings['global_icon']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($globalSettings['global_icon']))
                                            <img src="{{ Storage::url($globalSettings['global_icon']) }}" class="max-h-32 max-w-full object-contain" alt="Global Icon">
                                        @else
                                            <div class="flex flex-col items-center text-gray-400">
                                                <x-lucide-image class="w-12 h-12 mb-2 stroke-1" />
                                                <span class="text-xs font-medium">No Icon Uploaded</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Upload Input -->
                                    <div>
                                        <x-admin.image-cropper 
                                            id="global-icon" 
                                            name="icon" 
                                            label="Upload Global Icon File (.ico, .png, .svg)" 
                                            description="Max allowed size is 2 MB. PNGs will be compressed. Akan dipotong dengan rasio 1:1."
                                            aspect-ratio="1"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Global Favicon Card -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                                <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                        <x-lucide-globe class="w-5 h-5 text-secondary" /> Global Browser Tab Favicon
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">This favicon is rendered dynamically in the HTML head when users view all general pages of the company profile.</p>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                                    <!-- Preview -->
                                    <div class="flex flex-col items-center justify-center p-4 bg-gray-50 border border-dashed border-gray-200 rounded-xl h-44">
                                        @if(!empty($globalSettings['global_favicon']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($globalSettings['global_favicon']))
                                            <div class="p-4 bg-white border border-gray-100 rounded-xl shadow-sm flex items-center justify-center">
                                                <img src="{{ Storage::url($globalSettings['global_favicon']) }}" class="h-16 w-16 object-contain" alt="Global Favicon">
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center text-gray-400">
                                                <x-lucide-globe class="w-12 h-12 mb-2 stroke-1" />
                                                <span class="text-xs font-medium">No Favicon Uploaded</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Upload Input -->
                                    <div>
                                        <x-admin.image-cropper 
                                            id="global-favicon" 
                                            name="favicon" 
                                            label="Upload Global Favicon File (.ico, .png, .svg)" 
                                            description="Max allowed size is 2 MB. PNGs will be compressed. Akan dipotong dengan rasio 1:1."
                                            aspect-ratio="1"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Bar -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                            <x-primary-button>
                                <x-lucide-save class="w-4 h-4 mr-2" /> Save Global Assets
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @foreach($subsidiaries as $sub)
                    <div x-show="activeTab === '{{ $sub->slug }}'" x-cloak class="space-y-6">
                        <form action="{{ route('admin.company-assets.update', $sub->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Icon Config Card -->
                                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                                    <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                            <x-lucide-image class="w-5 h-5 text-secondary" /> Company Logo / Icon
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1">This icon represents the brand logo inside public sections and pages.</p>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                                        <!-- Preview -->
                                        <div class="flex flex-col items-center justify-center p-4 bg-gray-50 border border-dashed border-gray-200 rounded-xl h-44">
                                            @if($sub->icon_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($sub->icon_path))
                                                <img src="{{ Storage::url($sub->icon_path) }}" class="max-h-32 max-w-full object-contain" alt="{{ $sub->name }} Icon">
                                            @else
                                                <div class="flex flex-col items-center text-gray-400">
                                                    <x-lucide-image class="w-12 h-12 mb-2 stroke-1" />
                                                    <span class="text-xs font-medium">No Icon Uploaded</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Upload Input -->
                                        <div>
                                            <x-admin.image-cropper 
                                                id="icon-{{ $sub->id }}" 
                                                name="icon" 
                                                label="Upload Icon File (.ico, .png, .svg)" 
                                                description="Max allowed size is 2 MB. PNGs will be compressed. Akan dipotong dengan rasio 1:1."
                                                aspect-ratio="1"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Favicon Config Card -->
                                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                                    <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                            <x-lucide-globe class="w-5 h-5 text-secondary" /> Browser Tab Favicon
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1">This favicon is rendered dynamically in the HTML head when users view this company's section.</p>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                                        <!-- Preview -->
                                        <div class="flex flex-col items-center justify-center p-4 bg-gray-50 border border-dashed border-gray-200 rounded-xl h-44">
                                            @if($sub->favicon_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($sub->favicon_path))
                                                <div class="p-4 bg-white border border-gray-100 rounded-xl shadow-sm flex items-center justify-center">
                                                    <img src="{{ Storage::url($sub->favicon_path) }}" class="h-16 w-16 object-contain" alt="{{ $sub->name }} Favicon">
                                                </div>
                                            @else
                                                <div class="flex flex-col items-center text-gray-400">
                                                    <x-lucide-globe class="w-12 h-12 mb-2 stroke-1" />
                                                    <span class="text-xs font-medium">No Favicon Uploaded</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Upload Input -->
                                        <div>
                                            <x-admin.image-cropper 
                                                id="favicon-{{ $sub->id }}" 
                                                name="favicon" 
                                                label="Upload Favicon File (.ico, .png, .svg)" 
                                                description="Max allowed size is 2 MB. PNGs will be compressed. Akan dipotong dengan rasio 1:1."
                                                aspect-ratio="1"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Bar -->
                            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                                <x-primary-button>
                                    <x-lucide-save class="w-4 h-4 mr-2" /> Save Settings for {{ $sub->name }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>
