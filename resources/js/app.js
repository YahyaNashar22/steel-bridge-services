import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const initScrollReveal = () => {
    const nodes = document.querySelectorAll('.scroll-reveal');
    if (!nodes.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    // Keep subtle fade-out when leaving viewport for dynamic effect.
                    entry.target.classList.remove('is-visible');
                }
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -8% 0px' }
    );

    nodes.forEach((node, index) => {
        node.style.transitionDelay = `${Math.min(index * 45, 320)}ms`;
        observer.observe(node);
    });
};

document.addEventListener('DOMContentLoaded', initScrollReveal);
