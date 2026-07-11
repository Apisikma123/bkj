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
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Route Based CSS / JS --}}
    @stack('styles')
</head>
<body class="font-sans antialiased text-on-surface bg-background flex flex-col min-h-screen">
    <!-- Preloader -->
    <div id="global-preloader" class="fixed inset-0 z-[100] bg-surface flex flex-col items-center justify-center transition-opacity duration-500">
        <div class="relative w-16 h-16 mb-4">
            <div class="absolute inset-0 rounded-full border-4 border-outline-variant/30"></div>
            <div class="absolute inset-0 rounded-full border-4 border-primary border-t-transparent animate-spin"></div>
        </div>
        <img src="{{ asset('assets/logos/bkj-group-logo-dark.svg') }}" alt="BKJ Group" class="h-8 w-auto animate-pulse">
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
        // Hide preloader when everything is fully loaded
        window.addEventListener('load', function() {
            const preloader = document.getElementById('global-preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                    preloader.remove();
                }, 500);
            }
        });
    </script>
</body>
</html>
