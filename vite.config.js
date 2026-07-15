import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor-gsap': ['gsap', 'gsap/ScrollTrigger'],
                    'vendor-alpine': ['alpinejs'],
                    'vendor-sweetalert': ['sweetalert2'],
                    'vendor-lenis': ['@studio-freight/lenis'],
                },
            },
        },
    },
});
