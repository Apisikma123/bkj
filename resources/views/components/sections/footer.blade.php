@php
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

    $footerLogoUrl = null;
    if ($activeSubsidiary && $activeSubsidiary->icon_path) {
        $footerLogoUrl = \Illuminate\Support\Facades\Storage::url($activeSubsidiary->icon_path);
    } elseif (!empty($globalSettings['global_icon'])) {
        $footerLogoUrl = \Illuminate\Support\Facades\Storage::url($globalSettings['global_icon']);
    } else {
        $footerLogoUrl = asset('assets/logos/bkj-group-logo-light.svg');
    }
@endphp

<footer class="bg-primary text-white pt-20 pb-10 border-t-4 border-secondary">
    <x-layout.container>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 mb-12 md:mb-16">
            {{-- Brand Column --}}
            <div class="flex flex-col gap-6">
                <img src="{{ $footerLogoUrl }}" alt="BATAM KEPRI JAYA" class="h-12 w-auto object-contain self-start">
                <p class="text-on-primary-container text-body-md">
                    {{ __('home.footer_desc') }}
                </p>
                @php
                    $socialFacebook = $globalSettings['social_facebook'] ?? null;
                    $socialInstagram = $globalSettings['social_instagram'] ?? null;
                    $socialLinkedin = $globalSettings['social_linkedin'] ?? null;
                    $socialYoutube = $globalSettings['social_youtube'] ?? null;
                    $socialTiktok = $globalSettings['social_tiktok'] ?? null;
                    $socialWhatsapp = $globalSettings['contact_phone1'] ?? null;
                @endphp
                <div class="flex items-center gap-3 mt-2 flex-wrap">
                    @if(($globalSettings['social_facebook_active'] ?? '1') == '1' && $socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="Facebook"><x-lucide-facebook class="w-4 h-4" /></a>
                    @endif
                    @if(($globalSettings['social_instagram_active'] ?? '1') == '1' && $socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="Instagram"><x-lucide-instagram class="w-4 h-4" /></a>
                    @endif
                    @if(($globalSettings['social_linkedin_active'] ?? '1') == '1' && $socialLinkedin)
                        <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="LinkedIn"><x-lucide-linkedin class="w-4 h-4" /></a>
                    @endif
                    @if(($globalSettings['social_youtube_active'] ?? '1') == '1' && $socialYoutube)
                        <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="YouTube"><x-lucide-youtube class="w-4 h-4" /></a>
                    @endif
                    @if(($globalSettings['social_tiktok_active'] ?? '1') == '1' && $socialTiktok)
                        <a href="{{ $socialTiktok }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="TikTok"><x-lucide-video class="w-4 h-4" /></a>
                    @endif
                    @if($socialWhatsapp)
                        <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $socialWhatsapp) }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors" title="WhatsApp"><x-lucide-message-circle class="w-4 h-4" /></a>
                    @endif
                </div>
            </div>
            
            {{-- Quick Links --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-body-lg font-semibold text-secondary-container mb-2">{{ __('messages.quick_links') }}</h3>
                <a href="{{ route('home') }}" class="text-on-primary-container hover:text-white transition-colors">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="text-on-primary-container hover:text-white transition-colors">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}" class="text-on-primary-container hover:text-white transition-colors">{{ __('messages.services') }}</a>
                <a href="{{ route('gallery') }}" class="text-on-primary-container hover:text-white transition-colors">{{ __('messages.gallery') }}</a>
            </div>
            
            {{-- Subsidiaries --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-body-lg font-semibold text-secondary-container mb-2">{{ __('messages.subsidiaries') }}</h3>
                @foreach($globalSubsidiaries ?? [] as $sub)
                    <a href="{{ route('subsidiaries.show', $sub['slug']) }}" class="text-on-primary-container hover:text-white transition-colors">{{ $sub['name'] }}</a>
                @endforeach
            </div>

            {{-- Contact Us (4 Offices) --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-body-lg font-semibold text-secondary-container mb-2">{{ __('messages.contact_us') }}</h3>
                <div class="flex flex-col gap-6 text-on-primary-container text-xs">
                    @for ($i = 1; $i <= 4; $i++)
                        @php
                            $localeSuffix = app()->getLocale() === 'en' ? '_en' : '';
                            $isActive = ($globalSettings["office_{$i}_active"] ?? '1') == '1';
                            $officeName = !empty($globalSettings["office_{$i}_name{$localeSuffix}"]) ? $globalSettings["office_{$i}_name{$localeSuffix}"] : ($globalSettings["office_{$i}_name"] ?? null);
                            $officeTagline = !empty($globalSettings["office_{$i}_tagline{$localeSuffix}"]) ? $globalSettings["office_{$i}_tagline{$localeSuffix}"] : ($globalSettings["office_{$i}_tagline"] ?? null);
                            $officeAddress = !empty($globalSettings["office_{$i}_address{$localeSuffix}"]) ? $globalSettings["office_{$i}_address{$localeSuffix}"] : ($globalSettings["office_{$i}_address"] ?? null);
                            $officePhone = $globalSettings["office_{$i}_phone"] ?? null;
                            $officeEmail = $globalSettings["office_{$i}_email"] ?? null;
                        @endphp
                        @if($isActive && $officeName)
                            <div class="flex flex-col gap-2">
                                <h4 class="font-bold text-white text-xs leading-snug">
                                    {{ $officeName }}
                                    @if($officeTagline)
                                        <span class="text-[10px] font-normal text-secondary-container opacity-90 block mt-0.5">({{ $officeTagline }})</span>
                                    @endif
                                </h4>
                                @if($officeAddress)
                                    <p class="opacity-85 flex items-start gap-2 leading-relaxed">
                                        <span class="w-4 h-4 shrink-0 inline-flex items-center justify-center mt-0.5" style="width:16px;height:16px;"><x-lucide-map-pin class="w-4 h-4 text-secondary-container" style="width:16px;height:16px;" /></span>
                                        <span>{{ $officeAddress }}</span>
                                    </p>
                                @endif
                                @if($officePhone)
                                    <p class="opacity-85 flex items-center gap-2">
                                        <span class="w-4 h-4 shrink-0 inline-flex items-center justify-center" style="width:16px;height:16px;"><x-lucide-phone class="w-4 h-4 text-secondary-container" style="width:16px;height:16px;" /></span>
                                        <a href="tel:{{ str_replace(' ', '', $officePhone) }}" class="hover:text-white transition-colors">{{ $officePhone }}</a>
                                    </p>
                                @endif
                                @if($officeEmail)
                                    <p class="opacity-85 flex items-center gap-2">
                                        <span class="w-4 h-4 shrink-0 inline-flex items-center justify-center" style="width:16px;height:16px;"><x-lucide-mail class="w-4 h-4 text-secondary-container" style="width:16px;height:16px;" /></span>
                                        <a href="mailto:{{ $officeEmail }}" class="hover:text-white transition-colors truncate" title="{{ $officeEmail }}">{{ $officeEmail }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>


        <div class="pt-8 border-t border-primary-container flex flex-col md:flex-row items-center justify-between gap-4 text-on-primary-container text-sm">
            <p>&copy; {{ date('Y') }} Batam Kepri Jaya. {{ __('messages.all_rights_reserved') }}</p>
            <div class="flex gap-4">
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">{{ __('messages.terms') }}</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">{{ __('messages.privacy_policy') }}</a>
                <a href="{{ route('sitemap') }}" class="hover:text-white transition-colors">{{ __('messages.sitemap') }}</a>
            </div>
        </div>
    </x-layout.container>
</footer>
