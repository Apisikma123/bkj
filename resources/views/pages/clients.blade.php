<x-public-layout>
    @php $locale = app()->getLocale(); @endphp
    <x-slot:title>{{ $locale === 'en' ? 'Our Clients - BKJ Group' : 'Klien Kami - BKJ Group' }}</x-slot>

    <section class="py-32 bg-surface text-center">
        <x-layout.container>
            <h1 class="text-display-lg font-bold text-primary mb-6">{{ $locale === 'en' ? 'Our Clients' : 'Klien Kami' }}</h1>
            <p class="text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                {{ $locale === 'en' ? 'The trust given by our partners and clients is proof of our commitment to providing the best logistics and maritime services.' : 'Kepercayaan yang diberikan oleh mitra dan klien adalah bukti komitmen kami dalam memberikan layanan logistik dan maritim terbaik.' }}
            </p>
        </x-layout.container>
    </section>

    <section class="py-24 bg-white">
        <x-layout.container>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 items-center">
                @for($i = 1; $i <= 10; $i++)
                    <div class="relative group flex items-center justify-center p-6 bg-surface-container-lowest rounded-xl border border-outline-variant/30 shadow-sm hover:shadow-ambient transition-all duration-300">
                        <div class="w-full h-16 flex items-center justify-center text-on-surface-variant/50 font-bold tracking-wider grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300">
                            CLIENT {{ $i }}
                        </div>
                        <div class="absolute -bottom-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-label-md text-primary font-medium whitespace-nowrap">
                            Client Partner {{ $i }}
                        </div>
                    </div>
                @endfor
            </div>
        </x-layout.container>
    </section>
</x-public-layout>
