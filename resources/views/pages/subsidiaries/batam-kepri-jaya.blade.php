<x-public-layout>
    <x-slot:title>PT Batam Kepri Jaya</x-slot>

    @php $locale = app()->getLocale(); @endphp

    {{-- Hero Section --}}
    <x-sections.hero 
        title="PT Batam Kepri Jaya"
        subtitle="{{ $locale === 'en' ? 'Integrated Industrial Estate & Infrastructure' : 'Infrastruktur & Kawasan Industri Terintegrasi' }}"
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
                    <h2 class="text-headline-lg font-bold text-primary mb-6 leading-tight">{{ $locale === 'en' ? 'Industrial Estate & Maritime Facility Development' : 'Pengembangan Kawasan Industri & Fasilitas Maritim' }}</h2>
                    <p class="text-body-lg text-on-surface-variant leading-relaxed mb-10 bg-surface-container-low p-6 rounded-lg">
                        {{ $locale === 'en' ? 'PT Batam Kepri Jaya focuses on providing and managing infrastructure supporting the maritime industry. We support business growth in the Riau Islands through modern, strategic, and integrated facilities.' : 'PT Batam Kepri Jaya berfokus pada penyediaan dan pengelolaan infrastruktur penunjang industri maritim. Kami mendukung pertumbuhan bisnis di Kepulauan Riau melalui fasilitas yang modern, strategis, dan terintegrasi.' }}
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
                    "{{ $locale === 'en' ? 'To be the best developer and manager of maritime industrial infrastructure that supports regional economic growth.' : 'Menjadi pengembang dan pengelola infrastruktur industri maritim terbaik yang mendukung pertumbuhan ekonomi kawasan.' }}"
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
                        <span>{{ $locale === 'en' ? 'Provide facilities and industrial estates with international standards.' : 'Menyediakan fasilitas dan kawasan industri dengan standar internasional.' }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <x-lucide-check class="w-6 h-6 text-secondary shrink-0 mt-1" /> 
                        <span>{{ $locale === 'en' ? 'Build an ecosystem integrated with BKJ Group\'s logistics services.' : 'Membangun ekosistem yang terintegrasi dengan layanan logistik BKJ Group.' }}</span>
                    </li>
                </ul>
            </div>
        </x-layout.container>
    </section>

    {{-- Core Values --}}
    <section class="py-12 md:py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <h2 class="text-headline-lg font-bold text-primary">{{ $locale === 'en' ? 'Core Company Values' : 'Nilai Utama Perusahaan' }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <x-lucide-zap class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Innovative' : 'Inovatif' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Efficient and modern infrastructure development.' : 'Pembangunan infrastruktur yang efisien dan modern.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                        <x-lucide-shield-check class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Sustainable' : 'Berkelanjutan' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Focus on environmental balance in every estate project.' : 'Fokus pada keseimbangan lingkungan dalam setiap proyek kawasan.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-tertiary/10 text-tertiary rounded-full flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-white transition-colors duration-300">
                        <x-lucide-award class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">{{ $locale === 'en' ? 'Collaborative' : 'Kolaboratif' }}</h3>
                    <p class="text-body-md text-on-surface-variant">{{ $locale === 'en' ? 'Strategic partnerships to support the logistics ecosystem.' : 'Kemitraan strategis untuk mendukung ekosistem logistik.' }}</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Services --}}
    <section class="py-12 md:py-24 bg-surface-container-lowest border-y border-outline-variant/30" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <h2 class="text-headline-lg font-bold text-primary">{{ $locale === 'en' ? 'Infrastructure Solutions' : 'Solusi Infrastruktur' }}</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-building-2 class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">{{ $locale === 'en' ? 'Estate Development' : 'Pengembangan Kawasan' }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ $locale === 'en' ? 'Provision of land and basic infrastructure development for maritime industrial and logistics needs.' : 'Penyediaan lahan dan pembangunan infrastruktur dasar untuk kebutuhan industri dan logistik maritim.' }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-anchor class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">{{ $locale === 'en' ? 'Port Facilities' : 'Fasilitas Pelabuhan' }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ $locale === 'en' ? 'Management and provision of berthing facilities, warehouses, and other port operational support.' : 'Pengelolaan dan penyediaan fasilitas sandar, gudang, serta penunjang operasional pelabuhan lainnya.' }}</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- CTA Banner --}}
    <x-sections.cta-banner 
        title="{{ $locale === 'en' ? 'Explore Infrastructure Partnership Opportunities' : 'Jelajahi Peluang Kemitraan Infrastruktur' }}" 
        description="{{ $locale === 'en' ? 'Contact our team for further information on estate development.' : 'Hubungi tim kami untuk informasi pengembangan kawasan lebih lanjut.' }}"
        buttonText="{{ $locale === 'en' ? 'Contact Us' : 'Hubungi Kami' }}"
        buttonLink="{{ route('contact') }}"
    />
</x-public-layout>
