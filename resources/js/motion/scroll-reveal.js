import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function initScrollReveal() {
    // Respect user's motion preferences
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) {
        // If reduced motion is preferred, just make them visible immediately without animation
        const revealElements = document.querySelectorAll('[data-scroll-reveal], [data-scroll-stagger], [data-scroll-zoom], [data-scroll-fade-left], [data-scroll-fade-right]');
        revealElements.forEach(el => {
            gsap.set(el, { opacity: 1, y: 0, x: 0, scale: 1 });
        });
        return;
    }

    // 1. Standard Cinematic Reveal
    const revealElements = document.querySelectorAll('[data-scroll-reveal]');
    
    revealElements.forEach((el) => {
        gsap.fromTo(el, 
            { 
                y: 40, 
                opacity: 0,
                scale: 0.98
            },
            {
                y: 0,
                opacity: 1,
                scale: 1,
                duration: 0.6,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: el,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // 1.5 Diverse Animations
    document.querySelectorAll('[data-scroll-zoom]').forEach((el) => {
        gsap.fromTo(el, 
            { opacity: 0, scale: 0.8 },
            {
                opacity: 1, scale: 1, duration: 0.8, ease: "back.out(1.2)",
                scrollTrigger: { trigger: el, start: "top 85%", toggleActions: "play none none reverse" }
            }
        );
    });

    document.querySelectorAll('[data-scroll-fade-left]').forEach((el) => {
        gsap.fromTo(el, 
            { opacity: 0, x: -60 },
            {
                opacity: 1, x: 0, duration: 0.8, ease: "power2.out",
                scrollTrigger: { trigger: el, start: "top 85%", toggleActions: "play none none reverse" }
            }
        );
    });

    document.querySelectorAll('[data-scroll-fade-right]').forEach((el) => {
        gsap.fromTo(el, 
            { opacity: 0, x: 60 },
            {
                opacity: 1, x: 0, duration: 0.8, ease: "power2.out",
                scrollTrigger: { trigger: el, start: "top 85%", toggleActions: "play none none reverse" }
            }
        );
    });

    // 2. Staggered Reveal for Grids/Lists
    const staggerContainers = document.querySelectorAll('[data-scroll-stagger]');
    
    staggerContainers.forEach((container) => {
        const children = container.children;
        
        gsap.fromTo(children,
            {
                y: 30,
                opacity: 0
            },
            {
                y: 0,
                opacity: 1,
                duration: 0.5,
                stagger: 0.1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: container,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });
}
