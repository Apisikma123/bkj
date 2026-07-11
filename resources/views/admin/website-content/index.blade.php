<x-admin-layout>
    <div class="space-y-6" x-data="{ activeTab: 'home' }">
        <x-admin.page-header title="Website Content" subtitle="Manage your public website content directly." />

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex overflow-x-auto border-b border-gray-100 custom-scrollbar">
                <template x-for="tab in ['home', 'about', 'gallery', 'subsidiaries', 'contact', 'footer']">
                    <button @click="activeTab = tab"
                            class="px-6 py-4 text-sm font-medium transition-colors border-b-2 whitespace-nowrap capitalize"
                            :class="activeTab === tab ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'"
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="hero_title" value="Hero Title (ID)" required />
                                    <x-text-input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $hero->title ?? '') }}" required />
                                </div>
                                <div>
                                    <x-input-label for="hero_title_en" value="Hero Title (EN)" />
                                    <x-text-input id="hero_title_en" name="hero_title_en" type="text" value="{{ old('hero_title_en', $hero->title_en ?? '') }}" />
                                </div>
                                <div>
                                    <x-input-label for="hero_subtitle" value="Hero Subtitle (ID)" />
                                    <x-textarea-input id="hero_subtitle" name="hero_subtitle" rows="3">{{ old('hero_subtitle', $hero->subtitle ?? '') }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="hero_subtitle_en" value="Hero Subtitle (EN)" />
                                    <x-textarea-input id="hero_subtitle_en" name="hero_subtitle_en" rows="3">{{ old('hero_subtitle_en', $hero->subtitle_en ?? '') }}</x-textarea-input>
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="hero_image" value="Hero Image (Background)" />
                                    <input type="file" name="hero_image" id="hero_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer">
                                    @error('hero_image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                                    @if(!empty($hero->background_image))
                                        <div class="mt-3">
                                            <p class="text-sm font-medium text-on-surface mb-2">Current Image:</p>
                                            <img src="{{ Storage::url($hero->background_image) }}" class="h-32 object-cover border border-outline-variant/30 rounded-lg">
                                        </div>
                                    @endif
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
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="description" value="Description (ID)" />
                                    <x-textarea-input id="description" name="description" rows="4">{{ $profile['description'] ?? '' }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="description_en" value="Description (EN)" />
                                    <x-textarea-input id="description_en" name="description_en" rows="4">{{ $profile['description_en'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="vision" value="Vision (ID)" />
                                    <x-textarea-input id="vision" name="vision" rows="3">{{ $profile['vision'] ?? '' }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="vision_en" value="Vision (EN)" />
                                    <x-textarea-input id="vision_en" name="vision_en" rows="3">{{ $profile['vision_en'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="mission" value="Mission (ID)" />
                                    <x-textarea-input id="mission" name="mission" rows="3">{{ $profile['mission'] ?? '' }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="mission_en" value="Mission (EN)" />
                                    <x-textarea-input id="mission_en" name="mission_en" rows="3">{{ $profile['mission_en'] ?? '' }}</x-textarea-input>
                                </div>

                                <div>
                                    <x-input-label for="history" value="History / Background (ID)" />
                                    <x-textarea-input id="history" name="history" rows="3">{{ $profile['history'] ?? '' }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="history_en" value="History / Background (EN)" />
                                    <x-textarea-input id="history_en" name="history_en" rows="3">{{ $profile['history_en'] ?? '' }}</x-textarea-input>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <x-input-label for="team_members" value="Our Team (Pisahkan per baris)" />
                                    <x-textarea-input id="team_members" name="team_members" rows="4" placeholder="Sudirman (Direktur)&#10;Nandi (Komisaris)">{{ $settings['team_members'] ?? '' }}</x-textarea-input>
                                </div>
                                <div>
                                    <x-input-label for="company_legality" value="Company Legality (Pisahkan per baris)" />
                                    <x-textarea-input id="company_legality" name="company_legality" rows="4" placeholder="SIUP&#10;NIB">{{ $settings['company_legality'] ?? '' }}</x-textarea-input>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="about_image" value="About Image (Company Photo)" />
                                <input type="file" name="about_image" id="about_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer">
                                @if(!empty($profile['image']))
                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-on-surface mb-2">Current Image:</p>
                                        <img src="{{ Storage::url($profile['image']) }}" class="h-32 object-cover border border-outline-variant/30 rounded-lg">
                                    </div>
                                @endif
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
                    <div class="text-center py-12 text-gray-500">
                        <x-lucide-image class="w-12 h-12 mx-auto mb-3 opacity-50"/>
                        <p>Gallery settings and categories.</p>
                    </div>
                </div>
                
                <div x-show="activeTab === 'subsidiaries'" x-cloak>
                    <div class="text-center py-12 text-gray-500">
                        <x-lucide-building-2 class="w-12 h-12 mx-auto mb-3 opacity-50"/>
                        <p class="mb-4">Subsidiaries (Anak Perusahaan) are managed in their own dedicated module.</p>
                        <a href="{{ route('admin.subsidiaries.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            <x-lucide-edit class="w-5 h-5 mr-2" /> Manage Subsidiaries
                        </a>
                    </div>
                </div>


                <div x-show="activeTab === 'contact'" x-cloak>
                    <form action="{{ route('admin.content.updateContact') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="contact_email" value="Email" />
                                <x-text-input id="contact_email" name="contact_email" type="email" value="{{ $settings['contact_email'] ?? '' }}" />
                            </div>
                            <div class="row-span-2">
                                <x-input-label for="contact_address" value="Address" />
                                <x-textarea-input id="contact_address" name="contact_address" rows="5">{{ $settings['contact_address'] ?? '' }}</x-textarea-input>
                            </div>
                            <div>
                                <x-input-label for="contact_phone1" value="Phone 1" />
                                <x-text-input id="contact_phone1" name="contact_phone1" type="text" value="{{ $settings['contact_phone1'] ?? '' }}" />
                            </div>
                            <div>
                                <x-input-label for="contact_phone2" value="Phone 2 (Optional)" />
                                <x-text-input id="contact_phone2" name="contact_phone2" type="text" value="{{ $settings['contact_phone2'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                            <x-primary-button>
                                <x-lucide-save class="w-4 h-4 mr-2" /> Save Contact Info
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <div x-show="activeTab === 'footer'" x-cloak>
                    <form action="{{ route('admin.content.updateFooter') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="footer_copyright" value="Copyright Text" />
                                <x-text-input id="footer_copyright" name="footer_copyright" type="text" value="{{ $settings['footer_copyright'] ?? '© 2026 PT Bintang Kepri Jaya. All rights reserved.' }}" />
                            </div>
                            <div>
                                <x-input-label for="social_facebook" value="Facebook URL" />
                                <x-text-input id="social_facebook" name="social_facebook" type="url" value="{{ $settings['social_facebook'] ?? '' }}" />
                            </div>
                            <div>
                                <x-input-label for="social_instagram" value="Instagram URL" />
                                <x-text-input id="social_instagram" name="social_instagram" type="url" value="{{ $settings['social_instagram'] ?? '' }}" />
                            </div>
                            <div>
                                <x-input-label for="social_linkedin" value="LinkedIn URL" />
                                <x-text-input id="social_linkedin" name="social_linkedin" type="url" value="{{ $settings['social_linkedin'] ?? '' }}" />
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
