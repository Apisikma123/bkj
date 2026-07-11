<x-public-layout>
    <x-slot name="title">Halaman Tidak Ditemukan</x-slot>
    <x-slot name="description">Halaman yang Anda cari tidak dapat ditemukan.</x-slot>
    
    <section class="h-screen flex items-center justify-center bg-surface relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('/public/assets/images/hero-home.jpg')] opacity-5 bg-cover bg-center"></div>
        <x-layout.container class="relative z-10 text-center max-w-2xl">
            <div class="text-[12rem] font-bold text-primary/10 leading-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -z-10 pointer-events-none">404</div>
            
            <div class="w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                <x-lucide-compass class="w-12 h-12" />
            </div>
            
            <h1 class="text-display-lg font-bold text-primary mb-4">Kehilangan Arah?</h1>
            <p class="text-body-lg text-on-surface-variant mb-12">Halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia. Mari kembali ke rute yang benar.</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <x-ui.button variant="primary" size="lg" href="{{ route('home') }}"><x-lucide-home class="w-5 h-5 mr-2" /> Kembali ke Beranda</x-ui.button>
                <x-ui.button variant="secondary" size="lg" href="{{ route('services') }}">Lihat Layanan Kami</x-ui.button>
            </div>
        </x-layout.container>
    </section>
</x-public-layout>
