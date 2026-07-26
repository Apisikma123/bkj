---
name: Logistics Excellence System
colors:
  surface: '#ffffff'
  surface-dim: '#e3e6ec'
  surface-bright: '#ffffff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f5f7fb'
  surface-container: '#eef1f7'
  surface-container-high: '#e6e9f0'
  surface-container-highest: '#dde1e9'
  on-surface: '#0d1b2a'
  on-surface-variant: '#3b4963'
  inverse-surface: '#0d1b2a'
  inverse-on-surface: '#ffffff'
  outline: '#5c6b7e'
  outline-variant: '#a8b5c8'
  surface-tint: '#0d47a1'
  primary: '#0d47a1'
  on-primary: '#ffffff'
  primary-container: '#1565c0'
  on-primary-container: '#e3f2fd'
  inverse-primary: '#90caf9'
  secondary: '#0a3071'
  on-secondary: '#ffffff'
  secondary-container: '#bbdefb'
  on-secondary-container: '#0d47a1'
  tertiary: '#ffffff'
  on-tertiary: '#0d1b2a'
  tertiary-container: '#e8eaf6'
  on-tertiary-container: '#1a237e'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#bbdefb'
  primary-fixed-dim: '#90caf9'
  on-primary-fixed: '#0d1b2a'
  on-primary-fixed-variant: '#1565c0'
  secondary-fixed: '#e3f2fd'
  secondary-fixed-dim: '#bbdefb'
  on-secondary-fixed: '#0d1b2a'
  on-secondary-fixed-variant: '#0a3071'
  tertiary-fixed: '#ffffff'
  tertiary-fixed-dim: '#e8eaf6'
  on-tertiary-fixed: '#0d1b2a'
  on-tertiary-fixed-variant: '#3b4963'
  background: '#ffffff'
  on-background: '#0d1b2a'
  surface-variant: '#e8eaf6'
typography:
  display-lg:
    fontFamily: Poppins
    fontSize: 56px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Poppins
    fontSize: 40px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Poppins
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Poppins
    fontSize: 28px
    fontWeight: '600'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Poppins
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Poppins
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-md:
    fontFamily: Poppins
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
  max-width: 1440px
---

## Brand & Style

The design system is engineered to project the authority and precision of a high-end logistics and maritime enterprise. The brand personality is **reliable, industrial, and progressive**, targeting institutional clients and B2B partners who value efficiency and scale.

We adopt a **Modern Corporate** style characterized by:
- **Precision Engineering:** Sharp execution of grids and consistent spacing to reflect logistical accuracy.
- **High-End Utility:** A blend of professional utility and premium aesthetics, using the rich navy from the logo as a foundation for trust.
- **Kinetic Energy:** Sophisticated animations and transitions that suggest movement, progress, and the flow of global trade.
- **Clarity:** Uncluttered layouts that prioritize data and operational status without sacrificing visual appeal.

## Colors

The palette is strictly derived from the brand's identity, ensuring instant recognition and institutional cohesion.

- **Primary (Dark Navy):** Used for navigation, headings, and high-importance surfaces. It provides the "anchor" for the entire UI.
- **Secondary (Navy Blue):** Used for primary calls to action and secondary interactive elements to maintain a unified color scheme.
- **Tertiary (White/Light Grays):** Applied to backgrounds and surfaces to provide high-contrast visibility and a clean look.
- **Neutrals:** A range of cool grays and off-whites facilitate a clean, breathable background that prevents the bold primary colors from overwhelming the user.

## Typography

This design system utilizes **Poppins** across all levels to achieve a clean, geometric, and modern feel. The typeface’s open counters ensure legibility in technical logistics dashboards, while its bold weights provide the necessary impact for marketing headlines.

**Hierarchy Guidance:**
- Use **Display-LG** only for hero sections and key landing page statements.
- **Labels** should frequently use the uppercase styling with slight letter spacing to differentiate them from body text in dense data environments.
- Ensure a 4.5:1 contrast ratio is maintained for all body text against background surfaces.

## Layout & Spacing

The system employs a **12-column fluid grid** for desktop, transitioning to a **4-column grid** for mobile.

- **The 8px Rule:** All spacing between elements (paddings, margins) must be a multiple of 8px to ensure mathematical harmony.
- **Safe Zones:** High-end logistics vibes are maintained by "letting the design breathe." Avoid crowding data; use `section-padding-lg` (80px+) between major vertical content blocks on desktop.
- **Breakpoints:**
  - Mobile: < 600px
  - Tablet: 601px - 1024px
  - Desktop: 1025px+

## Elevation & Depth

We utilize **Tonal Layers** supplemented by **Ambient Shadows** to create a sophisticated sense of depth without clutter.

- **Surface Tiers:** Backgrounds use the Neutral-Light. Cards and containers use pure White (#FFFFFF).
- **Shadows:** Avoid harsh, black shadows. Use a "Navy-Tinted" shadow (e.g., `rgba(0, 50, 77, 0.08)`) with a high blur radius (20px+) and low vertical offset (4px-8px) for a soft, lifted effect.
- **Interactive Depth:** On hover, elements should slightly increase their elevation (shadow expansion) and scale by 1-2% to feel responsive and physical.

## Shapes

To maintain a **professional and industrial** aesthetic with a contemporary approachable feel, we use a **Rounded (0.5rem)** roundedness approach. This provides a modern, high-tech look that balances industrial precision with user-friendly ergonomics.

- **Standard Elements:** Inputs, buttons, and small cards use a 8px (0.5rem) radius.
- **Large Containers:** Hero images and modal overlays use 16px (1rem) to soften large surface areas.
- **Icons:** Should follow a consistent stroke weight (1.5px or 2px) with slightly rounded terminals to match the UI.

## Components

### Buttons
- **Primary:** Solid Navy Blue with White text. Subtle Light Navy shadow on hover.
- **Secondary:** Outlined Navy with 2px border. Transitions to solid Navy on hover.
- **Tertiary:** Ghost style (text only) in Navy with an underline that expands from center on hover.

### Input Fields
- Use a light gray/white background with a 1px border. On focus, the border transitions to Navy Blue with a soft glow (3px spread).

### Animation & Motion
The design system targets 60% animation coverage to feel "alive":
- **Smooth Scroll Reveals:** Elements should fade in and slide up (20px) as they enter the viewport using a `cubic-bezier(0.25, 1, 0.5, 1)` easing.
- **Staggered Entry:** Lists or grids of cards must enter with a 50ms delay between each item to create a "wave" effect.
- **Hover States:** Links and buttons should use a 200ms transition.

### Cards
- White background, 1px light gray border, and the ambient Navy-tinted shadow.
- Header of the card can optionally use a 4px top-border in Navy Blue to denote status.