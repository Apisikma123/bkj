<x-public-layout>
    <x-slot name="title">{{ __('pages.contact_title') }}</x-slot>
    <x-slot name="description">{{ __('contact.meta_description') }}</x-slot>
    
    <x-seo.meta title="{{ __('pages.contact_title') }}" description="{{ __('contact.meta_description') }}" />

    <div class="relative pt-24 pb-12 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-outline-variant/10 opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-surface to-transparent"></div>
        </div>
        <x-layout.container class="relative z-10 text-center">
            <span class="text-label-md text-secondary tracking-widest uppercase mb-4 block">{{ __('pages.contact_subtitle') }}</span>
            <h1 class="text-display-lg text-primary font-bold">{{ __('pages.contact_title') }}</h1>
        </x-layout.container>
    </div>

    <section class="py-16 pb-32 bg-surface min-h-screen">
        <x-layout.container>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-24">
                {{-- Contact Info --}}
                <div data-scroll-reveal>
                    <h2 class="text-headline-lg font-bold text-primary mb-8">{{ __('contact.info_title') }}</h2>
                    <p class="text-body-lg text-on-surface-variant mb-12 max-w-lg">
                        {{ __('contact.info_desc') }}
                    </p>
                    
                    <div class="space-y-6">
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
                                <div class="bg-white p-6 rounded-2xl border border-outline-variant/30 shadow-sm space-y-4 hover:shadow-ambient transition-shadow duration-300">
                                    <div>
                                        <h3 class="text-headline-md font-bold text-primary">{{ $officeName }}</h3>
                                        @if($officeTagline)
                                            <span class="inline-block text-[10px] font-semibold bg-secondary/10 text-secondary px-2 py-0.5 rounded uppercase tracking-wider mt-1">{{ $officeTagline }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="space-y-3 text-sm text-on-surface-variant">
                                        @if($officeAddress)
                                            <div class="flex items-start gap-3">
                                                <span class="w-5 h-5 shrink-0 inline-flex items-center justify-center mt-0.5" style="width:20px;height:20px;"><x-lucide-map-pin class="w-5 h-5 text-secondary" style="width:20px;height:20px;" /></span>
                                                <span class="flex-1">{{ $officeAddress }}</span>
                                            </div>
                                        @endif
                                        @if($officePhone)
                                            <div class="flex items-start gap-3">
                                                <span class="w-5 h-5 shrink-0 inline-flex items-center justify-center" style="width:20px;height:20px;"><x-lucide-phone class="w-5 h-5 text-secondary" style="width:20px;height:20px;" /></span>
                                                <a href="tel:{{ str_replace(' ', '', $officePhone) }}" class="hover:text-primary transition-colors font-medium">{{ $officePhone }}</a>
                                            </div>
                                        @endif
                                        @if($officeEmail)
                                            <div class="flex items-start gap-3">
                                                <span class="w-5 h-5 shrink-0 inline-flex items-center justify-center" style="width:20px;height:20px;"><x-lucide-mail class="w-5 h-5 text-secondary" style="width:20px;height:20px;" /></span>
                                                <a href="mailto:{{ $officeEmail }}" class="hover:text-primary transition-colors font-medium truncate" title="{{ $officeEmail }}">{{ $officeEmail }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
                
                {{-- Contact Form --}}
                <div class="bg-white p-6 md:p-10 lg:p-12 rounded-2xl lg:rounded-[2rem] shadow-ambient border border-outline-variant/30 relative" data-scroll-reveal>
                    <form action="{{ route('contact.submit') }}" method="POST" class="relative z-10 flex flex-col gap-6">
                        @csrf
                        
                        @if (session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-start gap-3 mb-2">
                                <x-lucide-check-circle class="w-5 h-5 text-green-600 mt-0.5 shrink-0" />
                                <div class="text-body-md">{{ session('success') }}</div>
                            </div>
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-label-md text-primary mb-2">{{ __('contact.form_name') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="{{ __('contact.form_name_placeholder') }}">
                                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="company" class="block text-label-md text-primary mb-2">{{ __('contact.form_company') }}</label>
                                <input type="text" id="company" name="company" value="{{ old('company') }}" class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="{{ __('contact.form_company_placeholder') }}">
                                @error('company')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        @php
                            $localeSuffix = app()->getLocale() === 'en' ? '_en' : '';
                            $opt1 = !empty($globalSettings["office_1_name{$localeSuffix}"]) ? $globalSettings["office_1_name{$localeSuffix}"] : ($globalSettings["office_1_name"] ?? 'PT. BINTANG KEPRI JAYA');
                            $opt2 = !empty($globalSettings["office_2_name{$localeSuffix}"]) ? $globalSettings["office_2_name{$localeSuffix}"] : ($globalSettings["office_2_name"] ?? 'KOPERASI JASA TBKM BINTANG KEPRI JAYA');
                            $opt3 = !empty($globalSettings["office_3_name{$localeSuffix}"]) ? $globalSettings["office_3_name{$localeSuffix}"] : ($globalSettings["office_3_name"] ?? 'PT BATAM KEPRI JAYA');
                            $opt4 = !empty($globalSettings["office_4_name{$localeSuffix}"]) ? $globalSettings["office_4_name{$localeSuffix}"] : ($globalSettings["office_4_name"] ?? 'PT BINTANG KEPRI JAYA');
                            
                            $tag1 = !empty($globalSettings["office_1_tagline{$localeSuffix}"]) ? $globalSettings["office_1_tagline{$localeSuffix}"] : ($globalSettings["office_1_tagline"] ?? 'BONGKAR MUAT');
                            $tag2 = !empty($globalSettings["office_2_tagline{$localeSuffix}"]) ? $globalSettings["office_2_tagline{$localeSuffix}"] : ($globalSettings["office_2_tagline"] ?? 'KOPERASI JASA TBKM');
                            $tag3 = !empty($globalSettings["office_3_tagline{$localeSuffix}"]) ? $globalSettings["office_3_tagline{$localeSuffix}"] : ($globalSettings["office_3_tagline"] ?? 'JASA PENGURUSAN TRANSPORTASI');
                            $tag4 = !empty($globalSettings["office_4_tagline{$localeSuffix}"]) ? $globalSettings["office_4_tagline{$localeSuffix}"] : ($globalSettings["office_4_tagline"] ?? 'BONGKAR MUAT');
                        @endphp
                        <div>
                            <label for="business_unit" class="block text-label-md text-primary mb-2">{{ __('contact.form_business_unit') }}</label>
                            <div class="relative">
                                <select id="business_unit" name="business_unit" class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md appearance-none" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3E%3Cpath stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'m6 8 4 4 4-4\'/%3E%3C/svg%3E'); background-position: right 1.25rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; padding-right: 2.5rem;">
                                    <option value="" disabled {{ old('business_unit') ? '' : 'selected' }}>{{ __('contact.form_business_unit_placeholder') }}</option>
                                    @if(($globalSettings['office_1_active'] ?? '1') == '1' && $opt1) <option value="{{ $opt1 }} - {{ $tag1 }} (Batu Ampar)" {{ old('business_unit') === "$opt1 - $tag1 (Batu Ampar)" ? 'selected' : '' }}>{{ $opt1 }} - {{ $tag1 }} (Batu Ampar)</option> @endif
                                    @if(($globalSettings['office_2_active'] ?? '1') == '1' && $opt2) <option value="{{ $opt2 }} (Batu Ampar)" {{ old('business_unit') === "$opt2 (Batu Ampar)" ? 'selected' : '' }}>{{ $opt2 }} (Batu Ampar)</option> @endif
                                    @if(($globalSettings['office_3_active'] ?? '1') == '1' && $opt3) <option value="{{ $opt3 }} - {{ $tag3 }} (Mega Legenda)" {{ old('business_unit') === "$opt3 - $tag3 (Mega Legenda)" ? 'selected' : '' }}>{{ $opt3 }} - {{ $tag3 }} (Mega Legenda)</option> @endif
                                    @if(($globalSettings['office_4_active'] ?? '1') == '1' && $opt4) <option value="{{ $opt4 }} - {{ $tag4 }} (Mega Legenda)" {{ old('business_unit') === "$opt4 - $tag4 (Mega Legenda)" ? 'selected' : '' }}>{{ $opt4 }} - {{ $tag4 }} (Mega Legenda)</option> @endif
                                </select>
                            </div>
                            @error('business_unit')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-label-md text-primary mb-2">{{ __('contact.form_email') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="{{ __('contact.form_email_placeholder') }}">
                            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="message" class="block text-label-md text-primary mb-2">{{ __('contact.form_message') }}</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md resize-none" placeholder="{{ __('contact.form_message_placeholder') }}">{{ old('message') }}</textarea>
                            @error('message')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        @if(!app()->environment('testing') && !empty(env('TURNSTILE_SITE_KEY')))
                            <div class="mt-2">
                                <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-theme="light"></div>
                                @error('cf-turnstile-response')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <x-ui.button variant="primary" size="lg" type="submit" class="w-full mt-4 justify-center">{{ __('contact.form_submit') }} <x-lucide-send class="w-5 h-5 ml-2" /></x-ui.button>
                    </form>
                </div>
            </div>
        </x-layout.container>
    </section>

    @if(!app()->environment('testing') && !empty(env('TURNSTILE_SITE_KEY')))
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
</x-public-layout>