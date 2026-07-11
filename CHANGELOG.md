# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]

### Added
- **Phase 1**: Initial documentation suite (`PRD.md`, `ARCHITECTURE.md`, etc.).
- **Phase 1.5**: Asset directories and `assets-manifest.md`.
- **Phase 2**: Laravel 11 project scaffold.
- **Phase 2**: Installed Vite, Tailwind CSS 4, AlpineJS, GSAP, Lenis.
- **Phase 2**: Installed Laravel Breeze, Spatie Media Library, Spatie Sitemap.
- **Phase 2**: Created Enterprise folder structure (`app/Actions`, `app/DTO`, etc.).
- **Phase 2**: Generated 17 migration files with complete schema definitions.
- **Phase 2**: Created `DatabaseSeeder.php` with real company data.
- **Phase 3**: Created `theme.css` mapped to design system variables.
- **Phase 3**: Developed reusable Blade components (`button`, `card`, `section-title`, `container`, `badge`, `whatsapp-button`, `navbar`, `footer`, `hero`, `cta-banner`, `statistic-card`, `service-card`).
- **Phase 3**: Integrated `lucide-laravel` icons.
- **Phase 4**: Implemented GSAP + Lenis modular Motion Engine (`animation-manager.js`, `scroll-reveal.js`, `hero-parallax.js`, etc.).
- **Phase 4**: Added `ANIMATION_GUIDE.md` to documentation.
- **Phase 4.5**: Designed Custom Admin UI System (`x-admin-layout`, `x-admin.sidebar`, `x-admin.table`).
- **Phase 4.5**: Built `DashboardController` and fully responsive Dashboard view.
- **Phase 4.5**: Scaffolded 13 robust CRUD Resource Controllers.
- **Phase 4.5**: Generated strictly standardized UI views (`index`, `create`, `edit`) for all 13 modules (Company, Subsidiaries, Services, Gallery, Blogs, Clients, Contacts, Banks, Media, SEO, Settings, Users, Logs).
- **Phase 4.5**: Registered strictly nested `Route::prefix('admin')` group inside `routes/web.php`.
- **Phase 5**: Implemented dynamic `public-layout.blade.php` to encapsulate Navbar and Footer.
- **Phase 5**: Developed full, high-end, responsive Home Page (`welcome.blade.php`) utilizing Blade components, Tailwind, and GSAP attributes.
- **Phase 5**: Rapidly scaffolded and completed 6 Sub-Pages (`about`, `services`, `gallery`, `blog`, `contact`, `subsidiaries`) using UI components.
- **Phase 5**: Wired all public routes inside `routes/web.php` properly with `Route::view()`.
- **Phase 5.5**: Engineered automated SEO Foundation (robots.txt, `Spatie\Sitemap`, custom `GenerateSitemap` artisan command).
- **Phase 5.5**: Built advanced `<x-seo.meta>` Blade component containing OpenGraph, JSON-LD Organization/LocalBusiness schemas, and Breadcrumb injection.
- **Phase 5.5**: Integrated `<x-seo.meta>` securely into `public-layout.blade.php`.
- **Phase 6**: Engineered high-performance `<x-ui.image>` component capable of multi-format `<picture>` rendering (WebP/AVIF), custom `fetchpriority`, and `lazy` loading.
- **Phase 6**: Replaced standard `<img>` tags in Hero and About sections with optimized `<x-ui.image>`.
- **Phase 6**: Injected `dns-prefetch` and `preconnect` headers in layout for faster external font resolution.
- **Phase 6**: Setup `@stack('scripts')` and `@stack('styles')` for Route Based Loading.
- **Phase 7**: Re-engineered `welcome.blade.php` to strictly follow the comprehensive 14-section sequence (Navbar -> Hero -> Overview -> Vision -> Core Values -> Statistics -> Services -> Why Choose Us -> Subsidiaries -> Gallery -> Clients -> News -> CTA -> Footer).

### Changed
- Configured `.env` to use MySQL connection.
- Refactored `app.js` to initialize GSAP and Alpine cleanly.
- Updated `app.css` to import Tailwind v4 and `theme.css`.
