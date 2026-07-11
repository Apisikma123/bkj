# System Architecture

## Overview
**Backend Framework**: Laravel 11
**Frontend Architecture**: Blade Components + TailwindCSS + Vanilla JS (GSAP for motion)
**Database**: MySQL / PostgreSQL (production), SQLite (local dev)
**Admin Panel**: FilamentPHP

## Directory Structure
- `app/Models/`: Eloquent Models.
- `app/Filament/`: Admin panel resources, pages, and widgets.
- `resources/views/components/`: Reusable UI components (buttons, cards, inputs).
- `resources/views/pages/`: Frontend page templates.
- `resources/css/`: Tailwind and custom CSS.
- `resources/js/`: GSAP logic and core JS utilities.

## Patterns
- **Resource Controllers**: Standard Laravel controllers for public views.
- **Service Classes**: Encapsulate complex business logic if needed.
- **Blade Components**: Strict usage of Blade components for DRY frontend code.
