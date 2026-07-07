/**
 * Intersection Observer for Animations
 */
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    const revealElements = document.querySelectorAll('.img-reveal');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class based on data attribute or default to fade-in-up
                const animationType = entry.target.dataset.animation || 'animate-fade-in-up';
                entry.target.classList.add(animationType);
                
                // If it's an image reveal
                if(entry.target.classList.contains('img-reveal')) {
                    entry.target.classList.add('is-visible');
                }

                // Stop observing once animated
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        // Ensure opacity is 0 before animation starts
        el.style.opacity = '0'; 
        observer.observe(el);
    });

    revealElements.forEach(el => {
        observer.observe(el);
    });
});
