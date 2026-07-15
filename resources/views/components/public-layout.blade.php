<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <x-seo.meta :title="$title ?? null" :description="$description ?? null" :image="$image ?? null" :breadcrumbs="$breadcrumbs ?? []" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Route Based CSS / JS --}}
    @stack('styles')
</head>
<body class="font-sans antialiased text-on-surface bg-background flex flex-col min-h-screen">
    @php
        $activeSubsidiary = null;
        if (isset($subsidiary) && $subsidiary instanceof \App\Models\Subsidiary) {
            $activeSubsidiary = $subsidiary;
        } else {
            $route = request()->route();
            if ($route && $route->getName() === 'subsidiaries.show') {
                $slug = $route->parameter('slug');
                $activeSubsidiary = \App\Models\Subsidiary::where('slug', $slug)->first();
            }
        }

        $logoUrl = null;
        if ($activeSubsidiary && $activeSubsidiary->icon_path) {
            $logoUrl = \Illuminate\Support\Facades\Storage::url($activeSubsidiary->icon_path);
        } elseif (!empty($globalSettings['global_icon'])) {
            $logoUrl = \Illuminate\Support\Facades\Storage::url($globalSettings['global_icon']);
        } else {
            $logoUrl = asset('assets/logos/bkj-group-logo-dark.svg');
        }
    @endphp

    <!-- Preloader -->
    <div id="global-preloader" class="fixed inset-0 z-[100] bg-surface flex flex-col items-center justify-center transition-opacity duration-500">
        <div class="relative w-16 h-16 mb-4">
            <div class="absolute inset-0 rounded-full border-4 border-outline-variant/30"></div>
            <div class="absolute inset-0 rounded-full border-4 border-primary border-t-transparent animate-spin"></div>
        </div>
        <img src="{{ $logoUrl }}" alt="BKJ Group" class="h-8 w-auto object-contain animate-pulse">
    </div>

    <x-sections.navbar />

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-sections.footer />
    <x-sections.whatsapp-button />
    
    {{-- Route Based JS --}}
    @stack('scripts')
    
    <script>
        // Hide preloader quickly when DOM is parsed, or within a maximum timeout of 1200ms
        (function() {
            const hidePreloader = () => {
                const preloader = document.getElementById('global-preloader');
                if (preloader) {
                    preloader.style.pointerEvents = 'none';
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        if (preloader.parentNode) {
                            preloader.style.display = 'none';
                            preloader.remove();
                        }
                    }, 500);
                }
            };
            
            // Hide on DOMContentLoaded (feels much faster)
            document.addEventListener('DOMContentLoaded', hidePreloader);
            // Fallback for safety
            window.addEventListener('load', hidePreloader);
            // Force hide after 1.2s max if load/DOM events are delayed
            setTimeout(hidePreloader, 600);
        })();
    </script>
</body>
</html>
