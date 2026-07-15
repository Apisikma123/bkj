<x-public-layout>
    <x-slot:title>PT Bintang Kepri Jaya</x-slot>

    @php $locale = app()->getLocale(); @endphp

    {{-- Hero Section --}}
    <x-sections.hero 
        title="PT Bintang Kepri Jaya"
        subtitle="{{ $locale === 'en' ? 'Trusted Shipping Agency & Logistics Solutions' : 'Solusi Logistik & Keagenan Kapal Terpercaya' }}"
        image=""
        primaryCta="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        primaryLink="{{ route('contact') }}"
    />

    {{-- Company Overview --}}
    <section class="py-12 md:py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                <div class="w-full lg:w-1/2 relative h-[250px] md:h-[400px] lg:h-[500px] flex items-center justify-center">
                    <div class="absolute inset-0 bg-primary/5 rounded-2xl transform -rotate-3 scale-95 transition-transform duration-700 hover:rotate-0 hover:scale-100"></div>
                    <div class="relative z-10 w-[85%] h-[85%] bg-outline-variant/10 rounded-2xl shadow-ambient"></div>
                </div>
                <div class="w-full lg:w-1/2">
                    <h2 class="text-headline-lg font-bold text-primary mb-6 leading-tight">{{ $locale === 'en' ? 'Best Shipping Agency & Forwarding in Kepri' : 'Keagenan Kapal & Forwarding Terbaik di Kepri' }}</h2>
                    <p class="text-body-lg text-on-surface-variant leading-relaxed mb-10 bg-surface-container-low p-6 rounded-lg">
                        {{ $locale === 'en' ? 'PT Bintang Kepri Jaya provides shipping agency (clearance in/out), stevedoring, and freight forwarding services with high operational standards. We ensure the smooth running of your logistics across all ports in the Riau Islands.' : 'PT Bintang Kepri Jaya menyediakan layanan keagenan kapal (clearance in/out), bongkar muat, dan freight forwarding dengan standar operasional tinggi. Kami memastikan kelancaran logistik Anda di seluruh pelabuhan Kepulauan Riau.' }}
                    </p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Vision Mission --}}
    <section class="py-12 md:py-24 bg-primary text-white relative overflow-hidden" data-scroll-reveal>
        <x-layout.container class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
            <div>
                <h3 class="text-label-md text-secondary-container tracking-widest uppercase mb-6">{{ $locale === 'en' ? 'Our Vision' : 'Visi Kami' }}</h3>
                <blockquote class="text-headline-md font-semibold leading-snug text-white/90">
                    "{{ $locale === 'en' ? 'To be the leading maritime logistics and shipping agency company with world-class services.' : 'Menjadi perusahaan keagenan kapal dan logistik maritim terdepan dengan layanan kelas dunia.' }}"
                </blockquote>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-6 md:p-10 rounded-2xl border border-white/10">
                <h3 class="text-headline-md font-bold mb-8 text-white flex items-center gap-4">
                    <span class="w-12 h-12 rounded-full bg-secondary text-white flex items-center justify-center shrink-0">
                        <x-lucide-flag class="w-6 h-6" />
                    </span>
                    {{ $locale === 'en' ? 'Mission' : 'Misi' }}
                </h3>
                <ul class="text-body-lg text-white/80 space-y-6">
                    <li class="flex items-start gap-4">
                        <x-lucide-check class="w-6 h-6 text-secondary shrink-0 mt-1" /> 
                        <span>{{ $locale === 'en' ? 'Provide the fastest and safest services for clients\' logistics efficiency.' : 'Memberikan layanan tercepat dan teraman untuk efisiensi logistik klien.' }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <x-lucide-check class="w-6 h-6 text-secondary shrink-0 mt-1" /> 
                        <span>{{ $locale === 'en' ? 'Comply with all maritime regulations and operational standards.' : 'Mematuhi seluruh regulasi maritim dan standar operasional.' }}</span>
                    </li>
                </ul>
            </div>
        </x-layout.container>
    </section>

    {{-- Core Values --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <h2 class="text-headline-lg font-bold text-primary">{{ $locale === 'en' ? 'Core Company Values' : 'Nilai Utama Perusahaan' }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <x-lucide-zap class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Fast' : 'Cepat' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Responsive clearance services for time efficiency.' : 'Layanan clearance yang responsif untuk efisiensi waktu.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                        <x-lucide-shield-check class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Safe' : 'Aman' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Compliance with safety standards and legal regulations.' : 'Kepatuhan pada standar keselamatan dan regulasi hukum.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-tertiary/10 text-tertiary rounded-full flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-white transition-colors duration-300">
                        <x-lucide-award class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Professional' : 'Profesional' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Handled by experienced maritime experts.' : 'Ditangani oleh tenaga ahli maritim berpengalaman.' }}</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Services --}}
    <section class="py-24 bg-surface-container-lowest border-y border-outline-variant/30" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <h2 class="text-headline-lg font-bold text-primary">{{ $locale === 'en' ? 'End-to-End Solutions' : 'Solusi End-to-End' }}</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-ship class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">{{ $locale === 'en' ? 'Shipping Agency' : 'Keagenan Kapal' }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ $locale === 'en' ? 'General agent services, clearance in/out processing, ship documents, and berthing equipment at the port.' : 'Layanan agen umum (general agent), pengurusan clearance in/out, dokumen kapal, dan perlengkapan sandar di pelabuhan.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-truck class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">{{ $locale === 'en' ? 'Freight Forwarding' : 'Freight Forwarding' }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ $locale === 'en' ? 'Efficient, safe, and timely cargo delivery via land, sea, and air for various logistics needs.' : 'Pengiriman kargo melalui darat, laut, dan udara secara efisien, aman, dan tepat waktu untuk berbagai kebutuhan logistik.' }}</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- CTA Banner --}}
    <x-sections.cta-banner 
        title="{{ $locale === 'en' ? 'Ready to Optimize Your Logistics?' : 'Siap Mengoptimalkan Logistik Anda?' }}" 
        description="{{ $locale === 'en' ? 'Consult your maritime logistics needs with our professional team.' : 'Konsultasikan kebutuhan logistik maritim Anda bersama tim profesional kami.' }}"
        buttonText="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        buttonLink="{{ route('contact') }}"
    />
</x-public-layout>
