<x-public-layout>
    <x-slot name="title">{{ __('messages.terms_of_service') }}</x-slot>
    <x-slot name="description">Syarat dan Ketentuan Layanan PT Bintang Kepri Jaya (BKJ Group).</x-slot>
    
    <x-seo.meta title="{{ __('messages.terms_of_service') }}" description="Syarat dan Ketentuan Layanan PT Bintang Kepri Jaya (BKJ Group)." />

    <section class="py-32 bg-surface min-h-screen">
        <x-layout.container class="max-w-4xl bg-white p-12 rounded-[2rem] shadow-ambient border border-outline-variant/30">
            <h1 class="text-headline-lg font-bold text-primary mb-8">{{ __('messages.terms_of_service') }}</h1>
            <div class="prose prose-lg prose-p:text-on-surface-variant max-w-none">
                <p>Terakhir diperbarui: {{ date('d M Y') }}</p>
                <p>Selamat datang di situs web PT Bintang Kepri Jaya. Syarat dan Ketentuan ini mengatur penggunaan Anda atas situs web kami. Dengan mengakses dan menggunakan situs ini, Anda menerima dan setuju untuk terikat oleh Syarat dan Ketentuan ini.</p>
                
                <h3 class="text-headline-md font-bold text-primary mt-8 mb-4">1. Penggunaan Situs</h3>
                <p>Situs ini disediakan untuk tujuan informasi mengenai layanan logistik, bongkar muat, dan keagenan kapal yang disediakan oleh BKJ Group. Anda setuju untuk menggunakan situs ini hanya untuk tujuan yang sah dan dengan cara yang tidak melanggar hak-hak, membatasi, atau menghambat penggunaan situs ini oleh pihak ketiga mana pun.</p>
                
                <h3 class="text-headline-md font-bold text-primary mt-8 mb-4">2. Kekayaan Intelektual</h3>
                <p>Semua konten, desain, logo, gambar, dan materi lain yang terdapat di situs ini adalah milik PT Bintang Kepri Jaya dan dilindungi oleh undang-undang hak cipta dan merek dagang. Anda tidak diizinkan untuk mereproduksi, memodifikasi, mendistribusikan, atau menggunakan konten kami untuk tujuan komersial tanpa izin tertulis dari kami.</p>
                
                <h3 class="text-headline-md font-bold text-primary mt-8 mb-4">3. Penolakan Tanggung Jawab</h3>
                <p>Meskipun kami berusaha memastikan bahwa informasi di situs ini akurat dan terkini, kami tidak memberikan jaminan apa pun, baik tersurat maupun tersirat, mengenai kelengkapan, keakuratan, keandalan, atau kesesuaian informasi tersebut. Penggunaan Anda atas situs ini sepenuhnya merupakan risiko Anda sendiri.</p>

                <h3 class="text-headline-md font-bold text-primary mt-8 mb-4">4. Perubahan Syarat</h3>
                <p>Kami berhak untuk mengubah, memodifikasi, menambah, atau menghapus bagian mana pun dari Syarat dan Ketentuan ini kapan saja. Perubahan akan segera berlaku setelah diunggah ke situs ini. Penggunaan berkelanjutan Anda atas situs ini setelah adanya perubahan menunjukkan penerimaan Anda terhadap perubahan tersebut.</p>
            </div>
        </x-layout.container>
    </section>
</x-public-layout>
