# Curved Auto-Scroll Marquee CTA — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a black, hero-style CTA section to the home page where a row of portrait image cards auto-scrolls (infinite marquee) while bent into a concave 3D arc, with centered "Ready to grow your brand?" copy and a Book a Call button.

**Architecture:** A new PHP partial (`components/curved-marquee.php`) renders the centered copy overlay plus a marquee track of image cards using the site's existing `[data-marquee]` convention. The existing GSAP tween in `main.js` scrolls the track; a new `curveMarquee()` pass bends each card per-frame by its distance from screen center. CSS in `app.css` supplies the perspective stage, card styling, and a static curved-fan fallback for reduced-motion / no-JS. `index.php` swaps `partial('cta')` for the new partial; `cta.php` is untouched (used on 6 other pages).

**Tech Stack:** PHP partials, Tailwind (CDN utility classes), GSAP + ScrollTrigger + Lenis (already loaded), vanilla CSS in `assets/css/app.css`.

## Global Constraints

- Do NOT modify `components/cta.php` — it is used by case-study.php, blog.php, post.php, service.php, work.php, services.php.
- Only swap the CTA call in `index.php` (line 15: `partial('cta');`).
- Accent color is `#CCEB00` (Tailwind class `bg-accent` / `text-accent`, dark `accent-dark`). Ink `#111`.
- Reuse existing marquee classes/JS hooks: container `[data-marquee]` + `data-speed`, track `.marquee__track`, group `.marquee__group`.
- Reuse `partial('button', [...])` for the CTA button. Escape dynamic strings with `e()`; build links with `url()`.
- Must degrade gracefully under `prefers-reduced-motion` / no-GSAP using the existing guard in `main.js` (the early `return` after `fallbackReveal()` at line 118-122).
- Verification is visual (browser), not unit tests. The XAMPP app is served at `http://localhost/d/`.

---

### Task 1: Build the curved-marquee partial (markup + content)

**Files:**
- Create: `components/curved-marquee.php`

**Interfaces:**
- Produces: a partial renderable via `partial('curved-marquee')`. Renders a `<section>` with:
  - root marquee container `<div class="curve-stage ..." data-curve-marquee data-marquee data-speed="18">`
  - track `<div class="marquee__track ...">` containing two `.marquee__group` copies of the card list
  - each card: `<div class="curve-card">...<img></div>`
  - a centered copy overlay block on top.
- Consumes: nothing from other tasks.

- [ ] **Step 1: Create the partial file**

Create `components/curved-marquee.php` with this exact content:

```php
<?php
/**
 * Curved auto-scroll marquee CTA (home page).
 * A row of portrait image cards auto-scrolls while bent into a concave 3D arc,
 * with centered copy + a Book a Call button floating on top.
 * Props: eyebrow, title, text, button (all optional).
 */
$eyebrow = $eyebrow ?? 'Get Started';
$title   = $title   ?? 'Ready to grow your brand?';
$text    = $text    ?? "Let's turn your social media into a powerful growth engine.";
$button  = $button  ?? 'Book a Call';

// Placeholder portrait images — swap for real assets later.
$cards = [
    'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1488161628813-04466f872be2?q=80&w=600&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1463453091185-61582044d556?q=80&w=600&auto=format&fit=crop',
];
?>
<section class="relative overflow-hidden bg-black">
    <!-- Curved marquee stage -->
    <div class="curve-stage flex min-h-[80vh] items-center"
         data-curve-marquee data-marquee data-speed="18">
        <div class="marquee__track curve-track">
            <?php for ($r = 0; $r < 2; $r++): ?>
                <div class="marquee__group curve-group" <?= $r === 1 ? 'aria-hidden="true"' : '' ?>>
                    <?php foreach ($cards as $src): ?>
                        <div class="curve-card">
                            <img src="<?= e($src) ?>" alt="" loading="lazy"
                                 class="h-full w-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Centered copy overlay -->
    <div class="pointer-events-none absolute inset-0 z-20 flex flex-col items-center justify-center px-6 text-center">
        <p class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-accent">
            <span class="h-1.5 w-1.5 rounded-full bg-accent"></span><?= e($eyebrow) ?>
        </p>
        <h2 class="font-display text-4xl font-bold leading-[1.05] text-white md:text-6xl">
            <?= e($title) ?>
        </h2>
        <p class="mt-5 max-w-md text-base text-white/55"><?= e($text) ?></p>
        <div class="pointer-events-auto mt-44 md:mt-56">
            <?php partial('button', ['text' => $button, 'href' => url('contact.php'), 'variant' => 'solid']); ?>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add components/curved-marquee.php
git commit -m "feat: add curved marquee CTA partial markup"
```

---

### Task 2: Add curve CSS (perspective stage, card styling, static fallback)

**Files:**
- Modify: `assets/css/app.css` (append a new section at end of file)

**Interfaces:**
- Consumes: class names emitted by Task 1 (`.curve-stage`, `.curve-track`, `.curve-group`, `.curve-card`).
- Produces: the perspective context + card geometry that Task 3's JS multiplies on top of, and a no-JS/reduced-motion static fan.

- [ ] **Step 1: Append the CSS**

Append to the end of `assets/css/app.css`:

```css
/* --------------------------------------------------------------------------
   Curved auto-scroll marquee CTA
   -------------------------------------------------------------------------- */
.curve-stage {
    perspective: 1200px;
    perspective-origin: 50% 50%;
}
.curve-track {
    display: inline-flex;
    transform-style: preserve-3d;
    will-change: transform;
}
.curve-group {
    display: inline-flex;
    align-items: center;
    flex-shrink: 0;
    transform-style: preserve-3d;
}
.curve-card {
    flex-shrink: 0;
    width: 11rem;          /* ~176px */
    aspect-ratio: 3 / 4;
    margin: 0 0.5rem;
    border-radius: 1rem;
    overflow: hidden;
    background: #1a1a1a;
    transform-style: preserve-3d;
    will-change: transform;
    backface-visibility: hidden;
}

/* Static concave fan for no-JS / reduced-motion (JS overrides per-card when active) */
.no-js .curve-card:nth-child(1),
.reduce-motion .curve-card:nth-child(1) { transform: rotateY(50deg) translateZ(-120px); }
.no-js .curve-card:nth-child(2),
.reduce-motion .curve-card:nth-child(2) { transform: rotateY(38deg) translateZ(-80px); }
.no-js .curve-card:nth-child(3),
.reduce-motion .curve-card:nth-child(3) { transform: rotateY(24deg) translateZ(-40px); }
.no-js .curve-card:nth-child(4),
.reduce-motion .curve-card:nth-child(4) { transform: rotateY(12deg) translateZ(-16px); }
.no-js .curve-card:nth-child(7),
.reduce-motion .curve-card:nth-child(7) { transform: rotateY(-12deg) translateZ(-16px); }
.no-js .curve-card:nth-child(8),
.reduce-motion .curve-card:nth-child(8) { transform: rotateY(-24deg) translateZ(-40px); }
.no-js .curve-card:nth-child(9),
.reduce-motion .curve-card:nth-child(9) { transform: rotateY(-38deg) translateZ(-80px); }
.no-js .curve-card:nth-child(10),
.reduce-motion .curve-card:nth-child(10) { transform: rotateY(-50deg) translateZ(-120px); }
```

- [ ] **Step 2: Commit**

```bash
git add assets/css/app.css
git commit -m "feat: curve marquee perspective + card styles + static fallback"
```

---

### Task 3: Add the `curveMarquee()` JS bend pass

**Files:**
- Modify: `assets/js/main.js` (add an initializer inside the GSAP path, after the marquee block ~line 231)

**Interfaces:**
- Consumes: `[data-curve-marquee]` container + `.curve-card` elements (Task 1); `window.gsap` ticker (already in scope as `gsap`).
- Produces: per-frame `transform: rotateY(...) translateZ(...) scale(...)` on each `.curve-card`, applied on top of the marquee's track translation.

- [ ] **Step 1: Add the initializer**

In `assets/js/main.js`, immediately AFTER the velocity-aware marquees block (the `gsap.utils.toArray('[data-marquee]')...` loop that ends around line 231) and BEFORE the "Footer wordmark reveal" comment, insert:

```javascript
    /* ----- Curved marquee: bend each card by distance from screen center ----- */
    gsap.utils.toArray('[data-curve-marquee]').forEach((stage) => {
        const cards = stage.querySelectorAll('.curve-card');
        if (!cards.length) return;

        const MAX_ROT = 52;   // max rotateY at the edges (deg)
        const MAX_Z = 130;    // how far edge cards recede (px)

        const bend = () => {
            const mid = window.innerWidth / 2;
            cards.forEach((card) => {
                const rect = card.getBoundingClientRect();
                const cx = rect.left + rect.width / 2;
                // normalised distance from center: -1 (far left) .. 0 .. 1 (far right)
                const t = Math.max(-1, Math.min(1, (cx - mid) / mid));
                const rot = -t * MAX_ROT;
                const z = -Math.abs(t) * MAX_Z;
                const scale = 1 - Math.abs(t) * 0.12;
                card.style.transform =
                    `rotateY(${rot}deg) translateZ(${z}px) scale(${scale})`;
            });
        };

        bend();
        gsap.ticker.add(bend);
        window.addEventListener('resize', bend);
    });
```

- [ ] **Step 2: Wire the partial into the home page**

In `index.php`, change line 15 from:

```php
    partial('cta');
```

to:

```php
    partial('curved-marquee');
```

- [ ] **Step 3: Verify in the browser**

Open `http://localhost/d/index.php`. Scroll to the bottom section. Confirm:
- Black band, centered "Ready to grow your brand?" + green "• Get Started" eyebrow + Book a Call button.
- Image cards auto-scroll horizontally and fan into a concave arc (edge cards rotated/receded, center cards flat).
- No console errors.

Then test the fallback: in DevTools, emulate `prefers-reduced-motion: reduce` (Rendering tab) and reload — cards should show a static curved fan (no scroll), still arced.

- [ ] **Step 4: Commit**

```bash
git add assets/js/main.js index.php
git commit -m "feat: curve cards per-frame and use curved-marquee on home page"
```

---

## Self-Review

- **Spec coverage:** black band + centered copy + Book a Call (Task 1) ✓; ~10 placeholder images (Task 1) ✓; bent concave arc via perspective + per-card rotateY/translateZ (Tasks 2+3) ✓; auto-scroll via existing `[data-marquee]` (Task 1 markup + existing tween) ✓; reduced-motion static fan (Task 2 fallback CSS) ✓; cta.php preserved, only index.php swapped (Task 3 + Global Constraints) ✓.
- **Placeholder scan:** no TBD/TODO; all code blocks complete.
- **Type consistency:** class names `.curve-stage/.curve-track/.curve-group/.curve-card` and attribute `data-curve-marquee` are identical across Tasks 1, 2, 3. Marquee hooks (`marquee__track`, `marquee__group`, `data-marquee`, `data-speed`) match the existing JS tween selectors.
```
