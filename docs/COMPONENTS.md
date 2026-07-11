# Component Guidelines

## Reusable Blade Components

### Layouts
- `<x-layouts.app>`: Main public layout (Header, Footer, WhatsApp FAB)
- `<x-layouts.guest>`: Clean layout without navigation.

### UI Elements
- `<x-ui.button>`: Configurable button (`primary`, `secondary`, `outline`).
- `<x-ui.section-title>`: Standardized section headers.
- `<x-ui.card>`: For Services and Blog posts.
- `<x-ui.badge>`: For tags and categories.

### Motion Components
- `<x-motion.fade-up>`: Wrapper for `data-fade-up` elements.
- `<x-motion.parallax>`: Wrapper for parallax images.

## CSS Architecture
- **Tailwind**: Used for utility classes, grid, flexbox, typography.
- **Custom CSS**: Minimal. Only for highly specific animations or pseudo-elements not easily achievable with Tailwind.
