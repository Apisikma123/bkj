<x-public-layout>
    <x-slot name="title">{{ __('pages.contact_title') }}</x-slot>
    <x-slot name="description">Dapatkan konsultasi gratis untuk solusi logistik Anda bersama BKJ Group.</x-slot>
    
    <x-seo.meta title="{{ __('pages.contact_title') }}" description="Dapatkan konsultasi gratis untuk solusi logistik Anda bersama BKJ Group." />

    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-primary overflow-hidden">
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
                {{-- Contact Info --}}
                <div data-scroll-reveal>
                    <h2 class="text-headline-lg font-bold text-primary mb-8">Mari Berkolaborasi Bersama Kami</h2>
                    <p class="text-body-lg text-on-surface-variant mb-12 max-w-lg">
                        Tingkatkan efisiensi rantai pasok Anda dengan solusi logistik terintegrasi berstandar internasional. Hubungi tim ahli kami untuk konsultasi gratis.
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
                                <h3 class="text-headline-md font-bold text-primary mb-2">Kantor Pusat</h3>
                                <p class="text-body-md text-on-surface-variant">{!! nl2br(e($contactAddress ?? 'Batam, Kepulauan Riau, Indonesia')) !!}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-white shadow-sm border border-outline-variant/30 text-secondary flex items-center justify-center rounded-2xl shrink-0"><x-lucide-phone class="w-6 h-6"/></div>
                            <div>
                                <h3 class="text-headline-md font-bold text-primary mb-2">Telepon</h3>
                                <p class="text-body-md text-on-surface-variant">{{ $contactPhone1 ?? '+62 123 4567 8900' }}</p>
                                @if(!empty($contactPhone2))
                                    <p class="text-body-md text-on-surface-variant mt-1">{{ $contactPhone2 }}</p>
                                @endif
                                <p class="text-label-md text-on-surface-variant uppercase tracking-wider mt-2">Senin - Jumat, 08:00 - 17:00</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-white shadow-sm border border-outline-variant/30 text-secondary flex items-center justify-center rounded-2xl shrink-0"><x-lucide-mail class="w-6 h-6"/></div>
                            <div>
                                <h3 class="text-headline-md font-bold text-primary mb-2">Email</h3>
                                <p class="text-body-md text-on-surface-variant">{{ $contactEmail ?? 'info@bkjgroup.com' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Contact Form --}}
                <div class="bg-white p-10 lg:p-12 rounded-[2rem] shadow-ambient border border-outline-variant/30 relative" data-scroll-reveal>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-secondary/10 rounded-full blur-2xl z-0 pointer-events-none"></div>
                    <form action="{{ route('contact.submit') }}" method="POST" class="relative z-10 flex flex-col gap-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-label-md text-primary mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="John Doe">
                            </div>
                            <div>
                                <label for="company" class="block text-label-md text-primary mb-2">Perusahaan</label>
                                <input type="text" id="company" name="company" class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="PT Contoh">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-label-md text-primary mb-2">Email Bisnis</label>
                            <input type="email" id="email" name="email" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md" placeholder="john@company.com">
                        </div>
                        <div>
                            <label for="message" class="block text-label-md text-primary mb-2">Pesan Anda</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-5 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors text-body-md resize-none" placeholder="Ceritakan kebutuhan logistik Anda..."></textarea>
                        </div>
                        <x-ui.button variant="primary" size="lg" type="submit" class="w-full mt-4 justify-center">Kirim Pesan <x-lucide-send class="w-5 h-5 ml-2" /></x-ui.button>
                    </form>
                </div>
            </div>
        </x-layout.container>
    </section>
</x-public-layout>