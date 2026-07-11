<x-public-layout>
    <x-slot:title>Koperasi TKBM Bintang Kepri Jaya</x-slot>

    {{-- Hero Section --}}
    <x-sections.hero 
        title="Koperasi TKBM Bintang Kepri Jaya"
        subtitle="Tenaga Kerja Bongkar Muat Tersertifikasi"
        image=""
        primaryCta="Hubungi Kami"
        primaryLink="{{ route('contact') }}"
    />

    {{-- Company Overview --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2 relative h-[500px] flex items-center justify-center">
                    <div class="absolute inset-0 bg-primary/5 rounded-2xl transform -rotate-3 scale-95 transition-transform duration-700 hover:rotate-0 hover:scale-100"></div>
                    <div class="relative z-10 w-[85%] h-[85%] bg-outline-variant/10 rounded-2xl shadow-ambient"></div>
                </div>
                <div class="w-full lg:w-1/2">
                    <span class="text-label-md text-secondary tracking-widest uppercase">Overview</span>
                    <h2 class="text-headline-lg font-bold text-primary mt-4 mb-6 leading-tight">Solusi Tenaga Kerja Maritim yang Andal</h2>
                    <p class="text-body-lg text-on-surface-variant leading-relaxed mb-10 border-l-4 border-secondary pl-6">
                        Koperasi Tenaga Kerja Bongkar Muat (TKBM) Bintang Kepri Jaya menyediakan SDM profesional dan tersertifikasi untuk menangani operasional bongkar muat di pelabuhan. Kami berkomitmen pada produktivitas dan keselamatan kerja.
                    </p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Vision Mission --}}
    <section class="py-24 bg-primary text-white relative overflow-hidden" data-scroll-reveal>
        <x-layout.container class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div>
                <h3 class="text-label-md text-secondary-container tracking-widest uppercase mb-6">Visi Kami</h3>
                <blockquote class="text-headline-md font-semibold leading-snug text-white/90">
                    "Menjadi mitra penyedia tenaga kerja bongkar muat terpercaya dengan standar keselamatan dan efisiensi tinggi."
                </blockquote>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-10 rounded-2xl border border-white/10">
                <h3 class="text-headline-md font-bold mb-8 text-white flex items-center gap-4">
                    <span class="w-12 h-12 rounded-full bg-secondary text-white flex items-center justify-center shrink-0">
                        <x-lucide-flag class="w-6 h-6" />
                    </span>
                    Misi
                </h3>
                <ul class="text-body-lg text-white/80 space-y-6">
                    <li class="flex items-start gap-4">
                        <x-lucide-check class="w-6 h-6 text-secondary shrink-0 mt-1" /> 
                        <span>Meningkatkan kesejahteraan anggota melalui manajemen koperasi yang transparan.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <x-lucide-check class="w-6 h-6 text-secondary shrink-0 mt-1" /> 
                        <span>Menjamin ketersediaan tenaga kerja yang terampil dan tersertifikasi (K3).</span>
                    </li>
                </ul>
            </div>
        </x-layout.container>
    </section>

    {{-- Core Values --}}
    <section class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <span class="text-label-md text-secondary tracking-widest uppercase">Core Values</span>
                <h2 class="text-headline-lg font-bold text-primary mt-4">Nilai Utama Koperasi</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <x-lucide-zap class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">Produktivitas</h3>
                    <p class="text-body-md text-on-surface-variant">Kinerja tinggi untuk memastikan ketepatan waktu operasional.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                        <x-lucide-shield-check class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">Keselamatan</h3>
                    <p class="text-body-md text-on-surface-variant">Penerapan standar K3 yang ketat di lingkungan pelabuhan.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-ambient group hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-tertiary/10 text-tertiary rounded-full flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-white transition-colors duration-300">
                        <x-lucide-award class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-bold text-primary mb-3">Kesejahteraan</h3>
                    <p class="text-body-md text-on-surface-variant">Berorientasi pada peningkatan kualitas hidup seluruh anggota Koperasi.</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- Services --}}
    <section class="py-24 bg-surface-container-lowest border-y border-outline-variant/30" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center mb-16">
                <span class="text-label-md text-secondary tracking-widest uppercase">Layanan Kami</span>
                <h2 class="text-headline-lg font-bold text-primary mt-4">Solusi Bongkar Muat</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-users-2 class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">Penyediaan Tenaga Kerja</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">Menyediakan SDM ahli dan tersertifikasi khusus untuk menangani proses stevedoring, cargodoring, dan receiving/delivery.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-outline-variant/30 shadow-sm flex flex-col h-full">
                    <x-lucide-shield-check class="w-12 h-12 text-primary mb-6" />
                    <h3 class="text-headline-md font-bold text-primary mb-4">Pelatihan & Sertifikasi</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">Menyelenggarakan pelatihan rutin dan peningkatan kapasitas anggota koperasi sesuai dengan standar K3 maritim internasional.</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- CTA Banner --}}
    <x-sections.cta-banner 
        title="Butuh Tenaga Profesional untuk Bongkar Muat?" 
        description="Pastikan operasional logistik Anda didukung oleh SDM yang kompeten dan tersertifikasi."
        buttonText="Hubungi Kami"
        buttonLink="{{ route('contact') }}"
    />
</x-public-layout>
