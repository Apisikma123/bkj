import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function initHeroParallax() {
    const heroImage = document.querySelector('[data-hero-parallax] img');
    const heroTexts = document.querySelectorAll('[data-hero-text]');
    
    if (!heroImage) return;

    // Image Parallax
    gsap.to(heroImage, {
        yPercent: 20,
        ease: "none",
        scrollTrigger: {
            trigger: "#hero",
            start: "top top",
            end: "bottom top",
            scrub: true
        }
    });

    // Text Reveal Stagger
    if (heroTexts.length) {
        gsap.fromTo(heroTexts, 
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 1, ease: "power3.out", stagger: 0.2, delay: 0.2 }
        );
    }
}
