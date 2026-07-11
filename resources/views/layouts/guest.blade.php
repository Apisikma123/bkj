<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Operations Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-on-surface antialiased bg-surface h-screen overflow-hidden selection:bg-secondary selection:text-white">
        <div class="flex min-h-screen">
            
            <!-- Left Side: Branding / Image (Hidden on Mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-primary items-center justify-center overflow-hidden">
                <!-- Logistics Background Image -->
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop" alt="Logistics Background" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay scale-105 hover:scale-100 transition-transform duration-[10s]">
                
                <!-- Ambient Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-container/90 via-primary/80 to-primary/95"></div>
                
                <!-- Content -->
                <div class="relative z-10 p-16 text-white max-w-2xl w-full">
                    <a href="/" class="inline-block mb-16 opacity-90 hover:opacity-100 transition-opacity">
                        {{-- Assuming application-logo is SVG, we can force white fill if needed, or just use text --}}
                        <div class="text-3xl font-display font-bold tracking-tight text-white flex items-center gap-3">
                            <x-lucide-anchor class="w-10 h-10 text-secondary-fixed" />
                            <span>PT BKJ</span>
                        </div>
                    </a>
                    
                    <h1 class="text-display-lg font-bold font-display leading-tight mb-8">
                        Logistics<br>
                        <span class="text-secondary-fixed">Excellence</span><br>
                        System
                    </h1>
                    
                    <div class="border-l-4 border-secondary-fixed pl-6 py-2 bg-gradient-to-r from-secondary-fixed/10 to-transparent">
                        <p class="text-body-lg text-inverse-primary font-medium max-w-md">
                            Enterprise-grade management portal for maritime and logistics operations. 
                            Authorized personnel only.
                        </p>
                    </div>
                </div>
                
                <!-- Tech Grid Pattern -->
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center relative bg-white shadow-[-20px_0_40px_rgba(0,28,46,0.05)] z-20">
                
                <!-- Back Button -->
                <div class="absolute top-8 right-8 sm:top-12 sm:right-12">
                    <a href="/" class="text-label-md text-outline hover:text-primary transition-colors uppercase tracking-widest flex items-center gap-2 px-4 py-2 rounded-full hover:bg-surface-container-low">
                        <x-lucide-arrow-left class="w-4 h-4" /> Back to Site
                    </a>
                </div>
                
                <!-- Main Form Container -->
                <div class="w-full max-w-[440px] px-8 py-10 relative">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden mb-12 flex justify-center">
                        <a href="/" class="text-2xl font-display font-bold text-primary flex items-center gap-2">
                            <x-lucide-anchor class="w-8 h-8 text-secondary" />
                            PT BKJ
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>
                
                <!-- Footer -->
                <div class="absolute bottom-8 sm:bottom-12 text-center text-[12px] font-medium tracking-wider uppercase text-outline w-full px-8">
                    &copy; {{ date('Y') }} PT Batam Kepri Jaya. All rights reserved.
                </div>
            </div>
            
        </div>
    </body>
</html>
