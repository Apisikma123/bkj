---
name: Logistics Excellence System
colors:
  surface: '#f7fafc'
  surface-dim: '#d7dadc'
  surface-bright: '#f7fafc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f4f6'
  surface-container: '#ebeef0'
  surface-container-high: '#e5e9eb'
  surface-container-highest: '#e0e3e5'
  on-surface: '#181c1e'
  on-surface-variant: '#42474d'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eef1f3'
  outline: '#72787e'
  outline-variant: '#c2c7ce'
  surface-tint: '#3c627f'
  primary: '#001c2e'
  on-primary: '#ffffff'
  primary-container: '#00324d'
  on-primary-container: '#759bba'
  inverse-primary: '#a4cbec'
  secondary: '#006e2d'
  on-secondary: '#ffffff'
  secondary-container: '#93f9a2'
  on-secondary-container: '#007430'
  tertiary: '#241800'
  on-tertiary: '#ffffff'
  tertiary-container: '#3e2c00'
  on-tertiary-container: '#bf8f00'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#cbe6ff'
  primary-fixed-dim: '#a4cbec'
  on-primary-fixed: '#001e30'
  on-primary-fixed-variant: '#224a66'
  secondary-fixed: '#93f9a2'
  secondary-fixed-dim: '#77dc88'
  on-secondary-fixed: '#002109'
  on-secondary-fixed-variant: '#005320'
  tertiary-fixed: '#ffdf9f'
  tertiary-fixed-dim: '#f7be2f'
  on-tertiary-fixed: '#261a00'
  on-tertiary-fixed-variant: '#5c4300'
  background: '#f7fafc'
  on-background: '#181c1e'
  surface-variant: '#e0e3e5'
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
- **Secondary (Emerald Green):** Used for growth indicators, primary calls to action, and success states.
- **Tertiary (Golden Yellow):** Applied to warning states, highlights, and secondary interactive elements to provide high-contrast visibility.
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
- **Primary:** Solid Emerald Green with White text. Subtle Navy shadow on hover.
- **Secondary:** Outlined Navy with 2px border. Transitions to solid Navy on hover.
- **Tertiary:** Ghost style (text only) in Navy with an underline that expands from center on hover.

### Input Fields
- Use a light gray background with a 1px border. On focus, the border transitions to Emerald Green with a soft glow (3px spread).

### Animation & Motion
The design system targets 60% animation coverage to feel "alive":
- **Smooth Scroll Reveals:** Elements should fade in and slide up (20px) as they enter the viewport using a `cubic-bezier(0.25, 1, 0.5, 1)` easing.
- **Staggered Entry:** Lists or grids of cards must enter with a 50ms delay between each item to create a "wave" effect.
- **Hover States:** Links and buttons should use a 200ms transition.

### Cards
- White background, 1px light gray border, and the ambient Navy-tinted shadow.
- Header of the card can optionally use a 4px top-border in Emerald Green or Golden Yellow to denote status.