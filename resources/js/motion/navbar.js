import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function initNavbar() {
    const navbar = document.getElementById('navbar');
    const container = document.getElementById('navbar-container');
    if (!navbar) return;

    ScrollTrigger.create({
        start: "top -80",
        onUpdate: (self) => {
            if (self.direction === 1) {
                // Scrolling down - hide navbar
                gsap.to(navbar, { yPercent: -100, duration: 0.4, ease: "power2.out" });
            } else {
                // Scrolling up - show navbar
                gsap.to(navbar, { yPercent: 0, duration: 0.4, ease: "power2.out" });
                
                // Add shadow if not at top
                if (self.progress > 0) {
                    navbar.classList.add('shadow-ambient');
                    container.classList.remove('h-20');
                    container.classList.add('h-16');
                }
            }
            
            // At absolute top
            if (self.progress === 0) {
                navbar.classList.remove('shadow-ambient');
                container.classList.remove('h-16');
                container.classList.add('h-20');
            }
        }
    });
}
