<x-admin-layout>
    <div class="space-y-6" x-data="{ activeTab: 'home' }">
        <x-admin.page-header title="Website Content" subtitle="Manage your public website content directly." />

        <div class="bg-white rounded-2xl shadow-sm border border-surface-container overflow-hidden">
            <div class="flex overflow-x-auto border-b border-surface-container custom-scrollbar">
                <template x-for="tab in ['home', 'about', 'gallery', 'subsidiaries', 'contact', 'footer']">
                    <button @click="activeTab = tab"
                            class="px-6 py-4 text-sm font-medium transition-colors border-b-2 whitespace-nowrap capitalize"
                            :class="activeTab === tab ? 'border-primary text-primary' : 'border-transparent text-outline hover:text-on-surface-variant hover:border-surface-container-highest'"
                            x-text="tab"></button>
                </template>
            </div>

            <div class="p-6">
                <!-- Home Tab -->
                <div x-show="activeTab === 'home'" x-cloak>
                    <form action="{{ route('admin.content.updateHome') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Hero Section -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/30">
                            <h3 class="text-lg font-bold text-on-surface mb-6 flex items-center gap-2">
                                <x-lucide-layout-template class="w-5 h-5 text-primary"/> Hero Section
                            </h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="hero_title" value="Hero Title" required />
                                    <x-text-input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $hero->title ?? '') }}" required />
                                </div>
                                <div>
                                    <x-input-label for="hero_subtitle" value="Hero Subtitle" />
                                    <x-textarea-input id="hero_subtitle" name="hero_subtitle" rows="3">{{ old('hero_subtitle', $hero->subtitle ?? '') }}</x-textarea-input>
                                </div>
                                <div class="md:col-span-2">
                                    <x-admin.image-cropper 
                                        id="hero_image" 
                                        name="hero_image" 
                                        label="Hero Image (Background)" 
                                        description="Maksimal 2 MB, format akan diconvert ke WebP. Akan dipotong dengan rasio 16:9."
                                        aspect-ratio="16/9"
                                        :current-image-url="!empty($hero->background_image) ? Storage::url($hero->background_image) : null"
                                    />
                                </div>
                            </div>
                        </div>


                        <div class="bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/30 mt-8">
                            <h3 class="text-lg font-bold text-on-surface mb-6 flex items-center gap-2">
                                <x-lucide-message-square class="w-5 h-5 text-primary"/> Client Testimonials
                            </h3>
                            <div>
                                <x-input-label for="client_testimonials" value="Testimonials (Satu per baris, pisahkan nama dengan tanda strip '-')" />
                                <x-textarea-input id="client_testimonials" name="client_testimonials" rows="5" placeholder="Layanan yang sangat memuaskan. - PT. Maju Bersama">{{ $settings['client_testimonials'] ?? '' }}</x-textarea-input>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                            <x-primary-button>
                                <x-lucide-save class="w-4 h-4 mr-2" /> Save Home Content
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- About Tab -->
                <div x-show="activeTab === 'about'" x-cloak>
                    <form action="{{ route('admin.content.updateAbout') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="name" value="Company Name" required />
                                <x-text-input id="name" name="name" type="text" value="{{ old('name', $profile['name'] ?? '') }}" required />
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="description" value="Description" />
                                    <x-textarea-input id="description" name="description" rows="4">{{ $profile['description'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="vision" value="Vision" />
                                    <x-textarea-input id="vision" name="vision" rows="3">{{ $profile['vision'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="mission" value="Mission" />
                                    <x-textarea-input id="mission" name="mission" rows="3">{{ $profile['mission'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="history" value="History / Background" />
                                    <x-textarea-input id="history" name="history" rows="3">{{ $profile['history'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-admin.image-cropper 
                                        id="about_image" 
                                        name="about_image" 
                                        label="Foto Profil Perusahaan (Opsional)" 
                                        description="Maksimal 2 MB, format akan diconvert ke WebP. Akan dipotong dengan rasio 16:9."
                                        aspect-ratio="16/9"
                                        :current-image-url="!empty($profile['image']) ? Storage::url($profile['image']) : null"
                                    />
                                </div>
                            </div>
                            

                        </div>
                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                            <x-primary-button>
                                <x-lucide-save class="w-4 h-4 mr-2" /> Save About Content
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                
                <!-- Gallery, Subsidiaries, Contact, Footer Tabs Follow Similar Pattern -->

                <div x-show="activeTab === 'gallery'" x-cloak>
                    <div class="text-center py-12 text-outline">
                        <x-lucide-image class="w-12 h-12 mx-auto mb-3 opacity-50"/>
                        <p class="mb-4">Gallery images are managed in their own dedicated module.</p>
                        <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            <x-lucide-edit class="w-5 h-5 mr-2" /> Manage Gallery
                        </a>
                    </div>
                </div>
                
                <div x-show="activeTab === 'subsidiaries'" x-cloak>
                    <div class="text-center py-12 text-outline">
                        <x-lucide-building-2 class="w-12 h-12 mx-auto mb-3 opacity-50"/>
                        <p class="mb-4">Subsidiaries (Anak Perusahaan) are managed in their own dedicated module.</p>
                        <a href="{{ route('admin.subsidiaries.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            <x-lucide-edit class="w-5 h-5 mr-2" /> Manage Subsidiaries
                        </a>
                    </div>
                </div>


                <div x-show="activeTab === 'contact'" x-cloak>
                    <form action="{{ route('admin.content.updateContact') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Offices Settings (Footer Grid) -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/30">
                            <h3 class="text-md font-bold text-primary flex items-center gap-2 pb-2 border-b border-outline-variant/20 mb-6">
                                <x-lucide-building-2 class="w-5 h-5 text-primary"/> Offices & Subsidiaries Address Grid (Footer)
                            </h3>
                            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                                <!-- Office 1 -->
                                <div class="bg-white rounded-xl p-6 border border-outline-variant/20 space-y-4 shadow-sm">
                                    <h4 class="text-sm font-bold text-secondary flex items-center gap-2 pb-2 border-b border-outline-variant/10">
                                        Office 1 (Batu Ampar Port)
                                    </h4>
                                    <div>
                                        <x-input-label for="office_1_name" value="Company / Office Name" required />
                                        <x-text-input id="office_1_name" name="office_1_name" type="text" value="{{ $settings['office_1_name'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_1_tagline" value="Business Type / Tagline" required />
                                        <x-text-input id="office_1_tagline" name="office_1_tagline" type="text" value="{{ $settings['office_1_tagline'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_1_address" value="Address" required />
                                        <x-textarea-input id="office_1_address" name="office_1_address" rows="3" required>{{ $settings['office_1_address'] ?? '' }}</x-textarea-input>
                                    </div>
                                    <div>
                                        <x-input-label for="office_1_phone" value="Phone" required />
                                        <x-text-input id="office_1_phone" name="office_1_phone" type="text" value="{{ $settings['office_1_phone'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_1_email" value="Email" required />
                                        <x-text-input id="office_1_email" name="office_1_email" type="email" value="{{ $settings['office_1_email'] ?? '' }}" required />
                                    </div>
                                </div>

                                <!-- Office 2 -->
                                <div class="bg-white rounded-xl p-6 border border-outline-variant/20 space-y-4 shadow-sm">
                                    <h4 class="text-sm font-bold text-secondary flex items-center gap-2 pb-2 border-b border-outline-variant/10">
                                        Office 2 (Koperasi Jasa TBKM - Batu Ampar)
                                    </h4>
                                    <div>
                                        <x-input-label for="office_2_name" value="Company / Office Name" required />
                                        <x-text-input id="office_2_name" name="office_2_name" type="text" value="{{ $settings['office_2_name'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_2_tagline" value="Business Type / Tagline" required />
                                        <x-text-input id="office_2_tagline" name="office_2_tagline" type="text" value="{{ $settings['office_2_tagline'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_2_address" value="Address" required />
                                        <x-textarea-input id="office_2_address" name="office_2_address" rows="3" required>{{ $settings['office_2_address'] ?? '' }}</x-textarea-input>
                                    </div>
                                    <div>
                                        <x-input-label for="office_2_phone" value="Phone" required />
                                        <x-text-input id="office_2_phone" name="office_2_phone" type="text" value="{{ $settings['office_2_phone'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_2_email" value="Email" required />
                                        <x-text-input id="office_2_email" name="office_2_email" type="email" value="{{ $settings['office_2_email'] ?? '' }}" required />
                                    </div>
                                </div>

                                <!-- Office 3 -->
                                <div class="bg-white rounded-xl p-6 border border-outline-variant/20 space-y-4 shadow-sm">
                                    <h4 class="text-sm font-bold text-secondary flex items-center gap-2 pb-2 border-b border-outline-variant/10">
                                        Office 3 (Mega Legenda - Transport)
                                    </h4>
                                    <div>
                                        <x-input-label for="office_3_name" value="Company / Office Name" required />
                                        <x-text-input id="office_3_name" name="office_3_name" type="text" value="{{ $settings['office_3_name'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_3_tagline" value="Business Type / Tagline" required />
                                        <x-text-input id="office_3_tagline" name="office_3_tagline" type="text" value="{{ $settings['office_3_tagline'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_3_address" value="Address" required />
                                        <x-textarea-input id="office_3_address" name="office_3_address" rows="3" required>{{ $settings['office_3_address'] ?? '' }}</x-textarea-input>
                                    </div>
                                    <div>
                                        <x-input-label for="office_3_phone" value="Phone" required />
                                        <x-text-input id="office_3_phone" name="office_3_phone" type="text" value="{{ $settings['office_3_phone'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_3_email" value="Email" required />
                                        <x-text-input id="office_3_email" name="office_3_email" type="email" value="{{ $settings['office_3_email'] ?? '' }}" required />
                                    </div>
                                </div>

                                <!-- Office 4 -->
                                <div class="bg-white rounded-xl p-6 border border-outline-variant/20 space-y-4 shadow-sm">
                                    <h4 class="text-sm font-bold text-secondary flex items-center gap-2 pb-2 border-b border-outline-variant/10">
                                        Office 4 (Mega Legenda - Stevedoring)
                                    </h4>
                                    <div>
                                        <x-input-label for="office_4_name" value="Company / Office Name" required />
                                        <x-text-input id="office_4_name" name="office_4_name" type="text" value="{{ $settings['office_4_name'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_4_tagline" value="Business Type / Tagline" required />
                                        <x-text-input id="office_4_tagline" name="office_4_tagline" type="text" value="{{ $settings['office_4_tagline'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_4_address" value="Address" required />
                                        <x-textarea-input id="office_4_address" name="office_4_address" rows="3" required>{{ $settings['office_4_address'] ?? '' }}</x-textarea-input>
                                    </div>
                                    <div>
                                        <x-input-label for="office_4_phone" value="Phone" required />
                                        <x-text-input id="office_4_phone" name="office_4_phone" type="text" value="{{ $settings['office_4_phone'] ?? '' }}" required />
                                    </div>
                                    <div>
                                        <x-input-label for="office_4_email" value="Email" required />
                                        <x-text-input id="office_4_email" name="office_4_email" type="email" value="{{ $settings['office_4_email'] ?? '' }}" required />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                                <x-primary-button>
                                    <x-lucide-save class="w-4 h-4 mr-2" /> Save Contact Info & Offices
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>

                <div x-show="activeTab === 'footer'" x-cloak>
                    <form action="{{ route('admin.content.updateFooter') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="footer_desc" value="Deskripsi Footer (ID)" />
                                <x-textarea-input id="footer_desc" name="footer_desc" rows="3">{{ $settings['footer_desc'] ?? __('home.footer_desc', [], 'id') }}</x-textarea-input>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="footer_desc_en" value="Footer Description (EN)" />
                                <x-textarea-input id="footer_desc_en" name="footer_desc_en" rows="3">{{ $settings['footer_desc_en'] ?? __('home.footer_desc', [], 'en') }}</x-textarea-input>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="footer_copyright" value="Copyright Text" />
                                <x-text-input id="footer_copyright" name="footer_copyright" type="text" value="{{ $settings['footer_copyright'] ?? '© 2026 Bintang Kepri Jaya. All rights reserved.' }}" />
                            </div>

                            <!-- Social Media Fields with Show/Hide Toggles -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_facebook" value="Facebook URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_facebook_active" value="1" {{ ($settings['social_facebook_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_facebook" name="social_facebook" type="url" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/yourpage" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_instagram" value="Instagram URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_instagram_active" value="1" {{ ($settings['social_instagram_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_instagram" name="social_instagram" type="url" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/yourprofile" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_linkedin" value="LinkedIn URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_linkedin_active" value="1" {{ ($settings['social_linkedin_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_linkedin" name="social_linkedin" type="url" value="{{ $settings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/company/yourcompany" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_twitter" value="Twitter / X URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_twitter_active" value="1" {{ ($settings['social_twitter_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_twitter" name="social_twitter" type="url" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://x.com/yourhandle" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_youtube" value="YouTube URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_youtube_active" value="1" {{ ($settings['social_youtube_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_youtube" name="social_youtube" type="url" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/@yourchannel" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <x-input-label for="social_tiktok" value="TikTok URL" />
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-primary">
                                        <input type="checkbox" name="social_tiktok_active" value="1" {{ ($settings['social_tiktok_active'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        Show Icon
                                    </label>
                                </div>
                                <x-text-input id="social_tiktok" name="social_tiktok" type="url" value="{{ $settings['social_tiktok'] ?? '' }}" placeholder="https://tiktok.com/@yourhandle" />
                            </div>

                        </div>
                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                            <x-primary-button>
                                <x-lucide-save class="w-4 h-4 mr-2" /> Save Footer
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
