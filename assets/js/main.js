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
       FAQ accordion (always runs)
       --------------------------------------------------------------------- */
    document.querySelectorAll('.faq-item').forEach((item) => {
        const trigger = item.querySelector('.faq-trigger');
        const panel = item.querySelector('.faq-panel');
        const icon = item.querySelector('.faq-icon');
        if (!trigger || !panel) return;
        trigger.addEventListener('click', () => {
            const open = panel.classList.toggle('is-open');
            panel.style.gridTemplateRows = open ? '1fr' : '0fr';
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (icon) icon.style.transform = open ? 'rotate(45deg)' : 'rotate(0deg)';
            if (open) {
                item.classList.add('border-ink/40');
            } else {
                item.classList.remove('border-ink/40');
            }
        });
    });

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

    /* ----- Curved marquee: bend each card by distance from screen center ----- */
    gsap.utils.toArray('[data-curve-marquee]').forEach((stage) => {
        const cards = stage.querySelectorAll('.curve-card');
        if (!cards.length) return;

        // Concave cylinder ("tunnel"): center cards face you and sit deepest,
        // edge cards wrap toward the viewer like the inside walls of a cylinder.
        const MAX_ROT = 72;    // edge rotateY (deg) — how hard the walls wrap in
        const CENTER_Z = -160; // center cards pushed back (deepest point)
        const EDGE_Z = 120;    // edge cards pulled toward viewer (the big panels)
        const EDGE_SCALE = 0.5; // extra size added to the outermost cards

        const bend = () => {
            const mid = window.innerWidth / 2;
            cards.forEach((card) => {
                const rect = card.getBoundingClientRect();
                const cx = rect.left + rect.width / 2;
                // normalised distance from center: -1 (far left) .. 0 .. 1 (far right)
                const t = Math.max(-1, Math.min(1, (cx - mid) / mid));
                const a = Math.abs(t);
                const rot = -t * MAX_ROT;                       // wrap toward viewer
                const z = CENTER_Z + (EDGE_Z - CENTER_Z) * a;   // edges forward, center back
                const scale = 1 + EDGE_SCALE * (a * a);         // edges grow into big panels
                card.style.transform =
                    `rotateY(${rot}deg) translateZ(${z}px) scale(${scale})`;
            });
        };

        bend();
        gsap.ticker.add(bend);
        window.addEventListener('resize', bend);
    });

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
