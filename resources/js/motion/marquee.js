import gsap from "gsap";

export default function initMarquee() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const marquees = document.querySelectorAll('[data-marquee]');
    
    marquees.forEach(marquee => {
        const direction = marquee.getAttribute('data-marquee') === 'right' ? 1 : -1;
        const track = marquee.querySelector('.marquee-track');
        
        if (!track) return;

        // Find the computed gap
        const gap = parseFloat(window.getComputedStyle(track).gap) || 0;
        const originalContent = track.innerHTML;
        
        // Wrap content so we can measure the original width accurately
        track.innerHTML = '';
        
        const originalDiv = document.createElement('div');
        originalDiv.className = 'flex shrink-0';
        originalDiv.style.gap = gap + 'px';
        originalDiv.innerHTML = originalContent;
        
        const cloneDiv = originalDiv.cloneNode(true);
        
        track.appendChild(originalDiv);
        track.appendChild(cloneDiv);

        // The exact distance to shift is the width of the original div + the gap
        const shiftDistance = originalDiv.offsetWidth + gap;

        let tween;

        if (direction === 1) {
            // Moving Right: start offset to the left, move to 0
            gsap.set(track, { x: -shiftDistance });
            tween = gsap.to(track, {
                x: 0,
                duration: 20,
                ease: "none",
                repeat: -1
            });
        } else {
            // Moving Left: start at 0, move offset to the left
            gsap.set(track, { x: 0 });
            tween = gsap.to(track, {
                x: -shiftDistance,
                duration: 20,
                ease: "none",
                repeat: -1
            });
        }

        // Pause on hover
        marquee.addEventListener('mouseenter', () => tween.pause());
        marquee.addEventListener('mouseleave', () => tween.play());

        // Use IntersectionObserver to pause/resume when in/out of viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    tween.play();
                } else {
                    tween.pause();
                }
            });
        }, { threshold: 0.01 });

        observer.observe(marquee);
    });
}
