@php
    $localeSuffix = app()->getLocale() === 'en' ? '_en' : '';
    
    $waOffices = [];
    for ($i = 1; $i <= 4; $i++) {
        $name = !empty($globalSettings["office_{$i}_name{$localeSuffix}"]) ? $globalSettings["office_{$i}_name{$localeSuffix}"] : ($globalSettings["office_{$i}_name"] ?? null);
        $tagline = !empty($globalSettings["office_{$i}_tagline{$localeSuffix}"]) ? $globalSettings["office_{$i}_tagline{$localeSuffix}"] : ($globalSettings["office_{$i}_tagline"] ?? null);
        $address = !empty($globalSettings["office_{$i}_address{$localeSuffix}"]) ? $globalSettings["office_{$i}_address{$localeSuffix}"] : ($globalSettings["office_{$i}_address"] ?? null);
        $phone = $globalSettings["office_{$i}_phone"] ?? null;
        
        if ($name && $phone) {
            $cleanPhone = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $phone);
            $waOffices[] = [
                'name' => $name,
                'tagline' => $tagline,
                'address' => $address,
                'phone' => $phone,
                'url' => $cleanPhone
            ];
        }
    }
    
    // Fallback if no office phone set
    if (count($waOffices) === 0 && !empty($globalSettings['contact_phone1'])) {
        $whatsappMain = $globalSettings['contact_phone1'];
        $cleanWa = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsappMain);
        $waOffices[] = [
            'name' => 'PT Bintang Kepri Jaya',
            'tagline' => 'Layanan Pelanggan',
            'address' => $globalSettings['contact_address'] ?? 'Kota Batam',
            'phone' => $whatsappMain,
            'url' => $cleanWa
        ];
    }
@endphp

@if(count($waOffices) > 0)
<div class="fixed bottom-6 right-6 pointer-events-auto" style="z-index: 110;" x-data="{ open: false }">
    {{-- Dropdown Menu (If multiple offices) --}}
    @if(count($waOffices) > 1)
        <div x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="absolute bottom-16 right-0 mb-4 bg-white rounded-2xl shadow-2xl border border-slate-100 p-3 w-80 sm:w-96 origin-bottom-right max-h-[80vh] overflow-y-auto" style="display: none;">
            
            <div class="p-3 border-b border-slate-100 mb-2">
                <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                    Hubungi Kami via WhatsApp
                </h4>
                <p class="text-xs text-slate-500 mt-1">Pilih unit usaha / alamat kantor yang ingin Anda hubungi:</p>
            </div>
            
            <div class="space-y-2">
                @foreach($waOffices as $item)
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-3 p-3 hover:bg-green-50/70 border border-slate-100 hover:border-green-200 rounded-xl transition-all duration-200">
                        <div class="w-9 h-9 bg-green-500/10 text-green-600 rounded-full flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-green-500 group-hover:text-white transition-colors">
                            <x-lucide-phone class="w-4 h-4" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-bold text-slate-800 leading-tight group-hover:text-green-700 transition-colors truncate">{{ $item['name'] }}</p>
                            @if($item['tagline'])
                                <span class="inline-block text-[10px] font-semibold text-secondary opacity-90 mt-0.5">({{ $item['tagline'] }})</span>
                            @endif
                            @if($item['address'])
                                <p class="text-[11px] text-slate-500 opacity-90 mt-1 line-clamp-2 leading-relaxed flex items-start gap-1">
                                    <span class="shrink-0 text-slate-400 mt-0.5 inline-flex items-center justify-center" style="width:12px;height:12px;"><x-lucide-map-pin class="w-3 h-3 text-slate-400" style="width:12px;height:12px;" /></span>
                                    <span>{{ $item['address'] }}</span>
                                </p>
                            @endif
                            <p class="text-xs font-semibold text-green-600 mt-1.5 flex items-center justify-between">
                                <span>{{ $item['phone'] }}</span>
                                <span class="text-[10px] font-normal text-slate-400 group-hover:text-green-600 font-medium">Chat WhatsApp &rarr;</span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Main Button --}}
    @if(count($waOffices) === 1)
        <a href="{{ $waOffices[0]['url'] }}" target="_blank" rel="noopener noreferrer" 
           aria-label="Hubungi kami via WhatsApp"
           class="group relative flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-hover hover:scale-110 transition-transform duration-200">
            <div class="absolute inset-0 rounded-full border-2 border-green-500 animate-[ping_1.5s_ease-out_3] opacity-75"></div>
            <svg class="w-7 h-7 relative z-10 fill-current text-white" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
            <div class="absolute right-full mr-4 bg-white text-slate-800 px-4 py-2 rounded-lg shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap text-sm font-semibold flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                Hubungi Kami
            </div>
        </a>
    @else
        <button @click="open = !open" 
           aria-label="Hubungi kami via WhatsApp"
           class="group relative flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-hover hover:scale-110 transition-transform duration-200">
            <div class="absolute inset-0 rounded-full border-2 border-green-500 animate-[ping_1.5s_ease-out_3] opacity-75" x-show="!open"></div>
            <svg class="w-7 h-7 relative z-10 transition-transform duration-300 fill-current text-white" x-bind:class="{'rotate-[-15deg] scale-110': open}" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
            <div class="absolute right-full mr-4 bg-white text-slate-800 px-4 py-2 rounded-lg shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap text-sm font-semibold flex items-center gap-2" x-show="!open">
                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                Hubungi Kami
            </div>
        </button>
    @endif
</div>
@endif
