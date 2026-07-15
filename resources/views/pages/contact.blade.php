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
                    
                    <div class="space-y-8">
                        @php
                            $contactAddress = $globalSettings['contact_address'] ?? null;
                            $contactPhone1 = $globalSettings['contact_phone1'] ?? null;
                            $contactPhone2 = $globalSettings['contact_phone2'] ?? null;
                            $contactEmail = $globalSettings['contact_email'] ?? null;
                        @endphp
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-white shadow-sm border border-outline-variant/30 text-secondary flex items-center justify-center rounded-2xl shrink-0"><x-lucide-map-pin class="w-6 h-6"/></div>
                            <div>
                                <h3 class="text-headline-md font-bold text-primary mb-2">{{ __('contact.office_title') }}</h3>
                                <p class="text-body-md text-on-surface-variant">{!! nl2br(e($contactAddress ?? 'Batam, Kepulauan Riau, Indonesia')) !!}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-white shadow-sm border border-outline-variant/30 text-secondary flex items-center justify-center rounded-2xl shrink-0"><x-lucide-phone class="w-6 h-6"/></div>
                            <div>
                                <h3 class="text-headline-md font-bold text-primary mb-2">{{ __('contact.phone_title') }}</h3>
                                <p class="text-body-md text-on-surface-variant">{{ $contactPhone1 ?? '+62 123 4567 8900' }}</p>
                                @if(!empty($contactPhone2))
                                    <p class="text-body-md text-on-surface-variant mt-1">{{ $contactPhone2 }}</p>
                                @endif
                                <p class="text-label-md text-on-surface-variant uppercase tracking-wider mt-2">{{ __('contact.hours') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-white shadow-sm border border-outline-variant/30 text-secondary flex items-center justify-center rounded-2xl shrink-0"><x-lucide-mail class="w-6 h-6"/></div>
                            <div>
                                <h3 class="text-headline-md font-bold text-primary mb-2">{{ __('contact.email_title') }}</h3>
                                <p class="text-body-md text-on-surface-variant">{{ $contactEmail ?? 'info@bkjgroup.com' }}</p>
                            </div>
                        </div>
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