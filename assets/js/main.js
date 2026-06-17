/* ==========================================================================
   Dyneixa Solutions — Lenis smooth scroll + GSAP animation system
   ========================================================================== */
(function () {
    'use strict';

    const html = document.documentElement;
    html.classList.remove('no-js');

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const hasGSAP = typeof window.gsap !== 'undefined';
    const hasLenis = typeof window.Lenis !== 'undefined';

    if (reduceMotion) {
        html.classList.add('reduce-motion');
    }

    /* ---------------------------------------------------------------------
       Mobile menu + sticky header (always runs, no deps)
       --------------------------------------------------------------------- */
    const navToggle = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (navToggle && mobileMenu) {
        navToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        mobileMenu.querySelectorAll('a').forEach((a) =>
            a.addEventListener('click', () => mobileMenu.classList.add('hidden'))
        );
    }

    const header = document.getElementById('site-header');
    if (header) {
        const onScroll = () => {
            if (window.scrollY > 40) header.classList.add('is-scrolled');
            else header.classList.remove('is-scrolled');
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* ---------------------------------------------------------------------
       Work-page filters (always runs)
       --------------------------------------------------------------------- */
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length) {
        filterBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const cat = btn.dataset.filter;
                filterBtns.forEach((b) => {
                    b.classList.remove('bg-surface', 'text-white', 'border-surface');
                    b.classList.add('text-ink');
                });
                btn.classList.add('bg-surface', 'text-white', 'border-surface');
                btn.classList.remove('text-ink');

                document.querySelectorAll('.filter-item').forEach((item) => {
                    const show = cat === 'All' || item.dataset.category === cat;
                    item.classList.toggle('is-hidden', !show);
                });
                if (window.ScrollTrigger) window.ScrollTrigger.refresh();
            });
        });
    }

    /* ---------------------------------------------------------------------
       Newsletter / inline form fake-submit (always runs)
       --------------------------------------------------------------------- */
    document.querySelectorAll('[data-newsletter]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const ok = form.querySelector('[data-newsletter-success]');
            if (ok) ok.classList.remove('hidden');
            form.querySelector('input[type="email"]').value = '';
        });
    });

    /* ---------------------------------------------------------------------
       Fallback reveal (no GSAP) — IntersectionObserver
       --------------------------------------------------------------------- */
    function fallbackReveal() {
        html.classList.add('reveal-ready');
        const els = document.querySelectorAll('[data-reveal]');
        if (!('IntersectionObserver' in window)) {
            els.forEach((el) => el.classList.add('is-visible'));
            return;
        }
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
        els.forEach((el) => io.observe(el));
    }

    if (reduceMotion || !hasGSAP) {
        fallbackReveal();
        initMarqueesCSS();
        return;
    }

    /* =====================================================================
       GSAP path
       ===================================================================== */
    const { gsap } = window;
    if (window.ScrollTrigger) gsap.registerPlugin(window.ScrollTrigger);
    const ScrollTrigger = window.ScrollTrigger;

    /* ----- Lenis smooth scroll, bridged to GSAP ticker ----- */
    let lenis = null;
    if (hasLenis) {
        lenis = new window.Lenis({
            duration: 1.1,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true,
        });
        lenis.on('scroll', () => ScrollTrigger && ScrollTrigger.update());
        gsap.ticker.add((time) => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);

        // Smooth in-page anchor links through Lenis
        document.querySelectorAll('a[href*="#"]').forEach((a) => {
            const url = new URL(a.href, location.href);
            if (url.pathname === location.pathname && url.hash.length > 1) {
                a.addEventListener('click', (e) => {
                    const target = document.querySelector(url.hash);
                    if (target) {
                        e.preventDefault();
                        lenis.scrollTo(target, { offset: -90 });
                    }
                });
            }
        });
    }

    /* ----- Hero headline split + stagger ----- */
    const heroTitle = document.querySelector('[data-hero-title]');
    if (heroTitle && typeof window.SplitType !== 'undefined') {
        const split = new window.SplitType(heroTitle, { types: 'lines,words' });
        gsap.set(heroTitle, { opacity: 1 });
        gsap.from(split.words, {
            yPercent: 110,
            opacity: 0,
            duration: 0.9,
            ease: 'power4.out',
            stagger: 0.04,
            delay: 0.15,
        });
    } else if (heroTitle) {
        gsap.from(heroTitle, { y: 40, opacity: 0, duration: 0.9, ease: 'power3.out' });
    }

    /* ----- Reveal on scroll (batch) ----- */
    const revealEls = gsap.utils.toArray('[data-reveal]');
    revealEls.forEach((el) => {
        const type = el.getAttribute('data-reveal');
        const from = { opacity: 0 };
        if (type === 'up') from.y = 50;
        if (type === 'scale') from.scale = 0.95;
        gsap.set(el, { opacity: 0 });
        gsap.to(el, {
            ...{ opacity: 1, y: 0, scale: 1 },
            duration: 0.9,
            ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 88%' },
        });
        gsap.set(el, from);
    });

    /* ----- Parallax blobs ----- */
    gsap.utils.toArray('[data-parallax]').forEach((el) => {
        const speed = parseFloat(el.getAttribute('data-parallax-speed') || '40');
        gsap.to(el, {
            y: speed,
            ease: 'none',
            scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true },
        });
    });

    /* ----- Velocity-aware marquees ----- */
    gsap.utils.toArray('[data-marquee]').forEach((wrap) => {
        const track = wrap.querySelector('.marquee__track');
        if (!track) return;
        const group = track.querySelector('.marquee__group');
        const width = group ? group.offsetWidth : track.offsetWidth / 2;
        const speed = parseFloat(wrap.getAttribute('data-speed') || '30');
        if (!width) return;

        const tween = gsap.to(track, {
            x: -width,
            duration: width / (speed * 4),
            ease: 'none',
            repeat: -1,
        });

        // Nudge speed/direction with scroll velocity
        if (ScrollTrigger) {
            ScrollTrigger.create({
                trigger: wrap,
                start: 'top bottom',
                end: 'bottom top',
                onUpdate: (self) => {
                    const v = self.getVelocity();
                    const dir = v < 0 ? -1 : 1;
                    tween.timeScale(dir * (1 + Math.min(Math.abs(v) / 1500, 2)));
                },
            });
        }
    });

    /* ----- Magnetic buttons ----- */
    if (!('ontouchstart' in window)) {
        document.querySelectorAll('[data-magnetic]').forEach((el) => {
            const strength = 0.35;
            el.addEventListener('mousemove', (e) => {
                const r = el.getBoundingClientRect();
                const x = (e.clientX - r.left - r.width / 2) * strength;
                const y = (e.clientY - r.top - r.height / 2) * strength;
                gsap.to(el, { x, y, duration: 0.4, ease: 'power3.out' });
            });
            el.addEventListener('mouseleave', () => {
                gsap.to(el, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
            });
        });
    }

    /* ----- Footer wordmark reveal ----- */
    const glitch = document.querySelector('[data-glitch]');
    if (glitch) {
        gsap.from(glitch, {
            scale: 0.92,
            opacity: 0,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: { trigger: glitch, start: 'top 95%' },
        });
    }

    if (ScrollTrigger) {
        window.addEventListener('load', () => ScrollTrigger.refresh());
    }

    /* ---------------------------------------------------------------------
       Plain CSS marquee fallback (used in reduced-motion / no-GSAP path)
       --------------------------------------------------------------------- */
    function initMarqueesCSS() {
        document.querySelectorAll('[data-marquee] .marquee__track').forEach((track) => {
            track.style.animation = 'none';
        });
    }
})();
