<div class="fixed bottom-6 right-6 pointer-events-auto" style="z-index: 110;" x-data="{ open: false }">
    {{-- Dropdown Menu --}}
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="absolute bottom-16 right-0 mb-4 bg-white rounded-xl shadow-xl border border-slate-100 p-2 w-64 origin-bottom-right" style="display: none;">
        
        <div class="p-3 border-b border-slate-100 mb-2">
            <h4 class="font-bold text-slate-800 text-sm">Hubungi Kami via WhatsApp</h4>
            <p class="text-xs text-slate-500 mt-1">Pilih salah satu admin kami:</p>
        </div>
        
        <a href="https://wa.me/6285264396766" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg transition-colors mb-1">
            <div class="w-10 h-10 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center shrink-0">
                <x-lucide-phone class="w-5 h-5" />
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800">Admin 1</p>
                <p class="text-xs text-slate-500">+62 852-6439-6766</p>
            </div>
        </a>
        
        <a href="https://wa.me/6281275885695" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg transition-colors">
            <div class="w-10 h-10 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center shrink-0">
                <x-lucide-phone class="w-5 h-5" />
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800">Admin 2</p>
                <p class="text-xs text-slate-500">+62 812-7588-5695</p>
            </div>
        </a>
    </div>

    {{-- Main Button --}}
    <button @click="open = !open" 
       aria-label="Hubungi kami via WhatsApp"
       class="group relative flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-hover hover:scale-110 transition-transform duration-200">
        
        {{-- Pulse animation ring --}}
        <div class="absolute inset-0 rounded-full border-2 border-green-500 animate-[ping_1.5s_ease-out_3] opacity-75" x-show="!open"></div>
        
        <x-lucide-message-circle class="w-7 h-7 relative z-10 transition-transform duration-300" x-bind:class="{'rotate-[-15deg] scale-110': open}" />
        
        {{-- Tooltip --}}
        <div class="absolute right-full mr-4 bg-white text-slate-800 px-4 py-2 rounded-lg shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap text-sm font-semibold flex items-center gap-2" x-show="!open">
            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
            Hubungi Kami
        </div>
    </button>
</div>
