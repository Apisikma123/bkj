import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import Lenis from "@studio-freight/lenis";

import initScrollReveal from "./scroll-reveal";
import initHeroParallax from "./hero-parallax";
import initCounter from "./counter";
import initNavbar from "./navbar";
import initMagneticButton from "./magnetic-button";
import initMarquee from "./marquee";

gsap.registerPlugin(ScrollTrigger);

export const initMotionEngine = () => {
    // Only initialize motion/lenis if we are on the public frontend (not in admin panel)
    // We can check if the admin sidebar exists to determine this
    if (document.querySelector('aside.w-64')) {
        return; // Disable smooth scrolling and animations in admin panel
    }

    // Initialize Smooth Scrolling (Lenis)
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: "vertical",
        gestureOrientation: "vertical",
        smoothWheel: true,
        wheelMultiplier: 1,
        touchMultiplier: 2,
    });

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    // Initialize Modules
    initNavbar();
    initScrollReveal();
    initHeroParallax();
    initCounter();
    initMagneticButton();
    initMarquee();

    // Memory Leak Cleanup (Phase 8 Audit)
    window.addEventListener('beforeunload', () => {
        ScrollTrigger.getAll().forEach(t => t.kill());
        gsap.globalTimeline.clear();
        lenis.destroy();
    });
};
