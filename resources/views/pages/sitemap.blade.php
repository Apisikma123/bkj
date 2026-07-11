<x-public-layout>
    <x-slot name="title">Peta Situs</x-slot>
    <x-slot name="description">Peta Situs (Sitemap) PT Bintang Kepri Jaya (BKJ Group).</x-slot>
    
    <x-seo.meta title="Peta Situs" description="Peta Situs (Sitemap) PT Bintang Kepri Jaya (BKJ Group)." />

    <section class="py-32 bg-surface min-h-screen">
        <x-layout.container class="max-w-4xl bg-white p-12 rounded-[2rem] shadow-ambient border border-outline-variant/30">
            <h1 class="text-headline-lg font-bold text-primary mb-12 flex items-center gap-4">
                <x-lucide-map class="w-10 h-10 text-secondary" /> Peta Situs
            </h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-title-lg font-bold text-primary mb-6 border-b border-outline-variant/30 pb-4">Halaman Utama</h3>
                    <ul class="space-y-4 text-body-lg text-on-surface-variant">
                        <li><a href="{{ route('home') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Tentang Kami</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Layanan Kami</a></li>
                        @foreach(\App\Models\Subsidiary::all() as $sub)
                            <li><a href="{{ route('subsidiaries.show', $sub->slug) }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> {{ $sub->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('gallery') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Galeri</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Blog & Berita</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-title-lg font-bold text-primary mb-6 border-b border-outline-variant/30 pb-4">Informasi Hukum</h3>
                    <ul class="space-y-4 text-body-lg text-on-surface-variant">
                        <li><a href="{{ route('privacy') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-secondary transition-colors inline-flex items-center gap-2"><x-lucide-chevron-right class="w-4 h-4" /> Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
        </x-layout.container>
    </section>
</x-public-layout>
