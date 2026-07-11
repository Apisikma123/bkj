# Motion & Animation Rules (BKJ Group)

## Core Philosophy
- **Kinetic Energy:** Animations must suggest movement, progress, and the flow of logistics.
- **60% Rule:** Do not over-animate. Only 60% of elements on a page should have entry animations to maintain performance and avoid overwhelming the user.
- **GPU Accelerated:** Animate ONLY `opacity`, `transform` (translate, scale, rotate), and `filter` (blur). Never animate layout properties (`width`, `height`, `margin`, `padding`, `top`, `left`).

## Timing & Easing
- **Fast:** 200ms (Hover states, small micro-interactions)
- **Normal:** 400ms - 600ms (Menu reveals, modal popups, simple fades)
- **Slow:** 800ms - 1200ms (Hero reveals, parallax transitions)
- **Easing:** `cubic-bezier(0.25, 1, 0.5, 1)` or GSAP `power3.out`. (Snap in, slow out)

## Scroll Reveal
- Uses Intersection Observer (`data-scroll-reveal`).
- Elements slide up by `30px` and fade in from `opacity: 0` to `1` over `800ms`.
- Stagger lists with a `100ms` delay between siblings.

## Hover Rules
- Buttons scale up by `2%` (`scale-[1.02]`) and increase shadow intensity (`shadow-hover`).
- Magnetic buttons track mouse movement up to `15px` from center.

## Lazy Loading
- Images use a blur-up technique. Fade transition `400ms` when fully loaded.
