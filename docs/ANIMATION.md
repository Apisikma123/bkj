# Animation Guidelines

## Core Principles
- **60% Coverage**: Do not over-animate. Animate only meaningful interactions.
- **GPU Accelerated**: Use `transform` and `opacity`. NEVER animate `width`, `height`, or `top/left/margin`.
- **Durations**: Smooth (0.6s to 1.2s depending on element size).
- **Easing**: Custom cubic-bezier (e.g., `power3.out` in GSAP).

## Target Animations
1. **Hero Reveal**: Text elements fade up staggeringly on load.
2. **Scroll Reveal**: Sections fade up as they enter the viewport (`IntersectionObserver`).
3. **Parallax**: Background images move at a fraction of the scroll speed.
4. **Card Stagger**: Grid items reveal one by one with a slight delay.
5. **Magnetic Button**: Hover effect on primary CTAs.
6. **Client Marquee**: Infinite horizontal scroll, pauses on hover.

## Tools
- **GSAP (GreenSock)**: For complex timelines and scroll triggers.
- **Vanilla CSS Transitions**: For simple hover states.
