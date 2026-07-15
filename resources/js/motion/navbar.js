import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function initNavbar() {
    const navbar = document.getElementById('navbar');
    const container = document.getElementById('navbar-container');
    if (!navbar) return;

    // Keep navbar fixed and always visible on mobile/tablet viewports (< 1024px)
    // Dynamic address bars on mobile trigger resize events that break scroll-hide logic.
    if (window.innerWidth < 1024) {
        return;
    }

    let isHidden = false;
    let isCompact = false;

    ScrollTrigger.create({
        start: "top -80",
        onUpdate: (self) => {
            // Bypass scroll hide/compact logic if mobile menu overlay is active
            if (document.body.classList.contains('overflow-hidden')) {
                return;
            }

            const scrollingDown = self.direction === 1;
            const progress = self.progress;

            // Show/hide logic
            if (scrollingDown && !isHidden) {
                isHidden = true;
                gsap.to(navbar, { yPercent: -100, duration: 0.4, ease: "power2.out", overwrite: "auto" });
            } else if (!scrollingDown && isHidden) {
                isHidden = false;
                gsap.to(navbar, { yPercent: 0, duration: 0.4, ease: "power2.out", overwrite: "auto" });
            }

            // Compact/shadow logic
            if (progress > 0 && !isCompact) {
                isCompact = true;
                navbar.classList.add('shadow-ambient');
                container.classList.remove('h-20');
                container.classList.add('h-16');
            } else if (progress === 0 && isCompact) {
                isCompact = false;
                navbar.classList.remove('shadow-ambient');
                container.classList.remove('h-16');
                container.classList.add('h-20');
            }
        }
    });
}
