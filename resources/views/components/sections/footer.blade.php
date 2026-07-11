<footer class="bg-primary text-white pt-20 pb-10 border-t-4 border-secondary">
    <x-layout.container>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            {{-- Brand Column --}}
            <div class="flex flex-col gap-6">
                <img src="{{ asset('assets/logos/bkj-group-logo-light.svg') }}" alt="PT. BATAM KEPRI JAYA" class="h-12 w-auto">
                <p class="text-on-primary-container text-body-md">
                    Perusahaan Jasa Pengurusan Transportasi (JPT) terpercaya, memberikan solusi layanan logistik dan transportasi yang profesional dan aman di Indonesia.
                </p>
                @php
                    $socialFacebook = $globalSettings['social_facebook'] ?? null;
                    $socialInstagram = $globalSettings['social_instagram'] ?? null;
                    $socialLinkedin = $globalSettings['social_linkedin'] ?? null;
                @endphp
                <div class="flex items-center gap-4 mt-2">
                    @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors"><x-lucide-facebook class="w-5 h-5" /></a>
                    @endif
                    @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors"><x-lucide-instagram class="w-5 h-5" /></a>
                    @endif
                    @if($socialLinkedin)
                        <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary transition-colors"><x-lucide-linkedin class="w-5 h-5" /></a>
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
            
            {{-- Contact --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-body-lg font-semibold text-secondary-container mb-2">{{ __('messages.contact_us') }}</h3>
                @php
                    $contactAddress = $globalSettings['contact_address'] ?? null;
                    $contactPhone1 = $globalSettings['contact_phone1'] ?? null;
                    $contactPhone2 = $globalSettings['contact_phone2'] ?? null;
                    $contactEmail = $globalSettings['contact_email'] ?? null;
                @endphp
                <div class="flex items-start gap-3 text-on-primary-container">
                    <x-lucide-map-pin class="w-5 h-5 shrink-0 mt-1" />
                    <span>{!! nl2br(e($contactAddress ?? 'Batam, Indonesia')) !!}</span>
                </div>
                <div class="flex items-start gap-3 text-on-primary-container">
                    <x-lucide-phone class="w-5 h-5 shrink-0 mt-1" />
                    <span>
                        {{ $contactPhone1 }}
                        @if($contactPhone2)<br>{{ $contactPhone2 }}@endif
                    </span>
                </div>
                <div class="flex items-center gap-3 text-on-primary-container">
                    <x-lucide-mail class="w-5 h-5 shrink-0" />
                    <span>{{ $contactEmail ?? 'info@bkjgroup.com' }}</span>
                </div>
            </div>
        </div>
        
        <div class="pt-8 border-t border-primary-container flex flex-col md:flex-row items-center justify-between gap-4 text-on-primary-container text-sm">
            <p>&copy; {{ date('Y') }} PT. Batam Kepri Jaya. {{ __('messages.all_rights_reserved') }}</p>
            <div class="flex gap-4">
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">{{ __('messages.terms') }}</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">{{ __('messages.privacy_policy') }}</a>
                <a href="{{ route('sitemap') }}" class="hover:text-white transition-colors">{{ __('messages.sitemap') }}</a>
            </div>
        </div>
    </x-layout.container>
</footer>
