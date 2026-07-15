<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BKJ Group') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-surface text-on-surface flex h-screen overflow-hidden" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" @resize.window="if (window.innerWidth >= 1024) sidebarOpen = true">
    
    <!-- Sidebar backdrop (only visible on mobile when sidebar is open) -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="lg:hidden fixed inset-0 bg-black/40 z-30 transition-opacity duration-300"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
    </div>

    <!-- Sidebar -->
    <x-admin.sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <!-- Top Navbar -->
        <x-admin.topbar />

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 bg-surface-container-low relative">
            {{ $slot }}
        </main>
    </div>

    @if (session('success'))
        <script type="module">
            if (window.Alert) window.Alert.success('{!! addslashes(session('success')) !!}');
        </script>
    @endif
    
    @if (session('error'))
        <script type="module">
            if (window.Alert) window.Alert.error('{!! addslashes(session('error')) !!}');
        </script>
    @endif
    
    @if ($errors->any())
        <script type="module">
            if (window.Alert) {
                let errorList = '<ul class="list-disc pl-5 mt-2 text-left text-sm text-gray-600">';
                @foreach ($errors->all() as $error)
                    errorList += '<li>{!! addslashes($error) !!}</li>';
                @endforeach
                errorList += '</ul>';
                
                window.Alert.warning(`
                    <div class="mb-2">Periksa kembali data yang Anda masukkan:</div>
                    ${errorList}
                `);
            }
        </script>
    @endif

    @stack('scripts')
</body>
</html>
