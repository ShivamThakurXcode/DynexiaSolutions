# Curved Auto-Scroll Marquee CTA — Design

**Date:** 2026-06-19
**Status:** Approved (design phase)

## Goal

Add a hero-style CTA section to the home page that matches the reference screenshot:
a full-width black band with a centered headline ("Ready to grow your brand?") and a
**Book a Call** pill button, set against a horizontal row of portrait image cards that
**auto-scroll** (infinite marquee) while **bent into a concave 3D arc** (cards fan away
from the viewer at both edges).

## Scope

- Replace the CTA **only on the home page** (`index.php`).
- `components/cta.php` stays untouched — it is used on 6 other pages
  (case-study, blog, post, service, work, services).

## Files

1. **`components/curved-marquee.php`** (new) — partial containing:
   - `$cards` array (~10 placeholder portrait image URLs, easy to swap later).
   - Centered copy block: `• Get Started` eyebrow (accent), `Ready to grow your brand?`
     headline, two-line sub-text, and a `Book a Call` pill button (reuses `partial('button')`).
   - Marquee markup using the existing `[data-marquee]` / `.marquee__track` / `.marquee__group`
     convention so the existing infinite-loop GSAP tween drives it. Cards rendered twice
     (two groups) for seamless looping.
2. **`assets/css/app.css`** — `.curve-*` styles: `perspective` on the stage, card base
   transform/size, and a static curved-fan fallback for reduced-motion / no-JS.
3. **`assets/js/main.js`** — a `curveMarquee()` pass that, for each card, computes its
   horizontal distance from the viewport center and sets `rotateY` + `translateZ` so the
   row reads as a concave arc; runs on the GSAP ticker (and on resize). Cards flowing
   through the center straighten, then bend away — the arc is fixed, images flow through it.
4. **`index.php`** — swap `partial('cta')` → `partial('curved-marquee')`.

## Behavior

- **Default (GSAP available):** existing marquee tween scrolls the track left infinitely;
  `curveMarquee()` re-applies per-card 3D bend each frame based on screen-X distance from center.
- **Reduced motion / no GSAP:** existing guard in `main.js` skips the GSAP path. Cards
  render in a static concave fan via CSS (no scroll), still matching the screenshot shape.

## Visual spec

- Band: `bg-black`, ~`min-h-[80vh]`, vertically centered content.
- Card: portrait (~`w-44 aspect-[3/4]`), `rounded-2xl`, `overflow-hidden`, object-cover image.
- Arc: max `rotateY` ≈ ±45–55° at the edges, scaled by distance from center; `translateZ`
  pulls edge cards back so they recede. `perspective` ≈ 1200px on the stage.
- Text block sits in an absolutely-positioned, centered overlay above the cards
  (`z-index` above the marquee), so the row passes behind it like the screenshot.
- Eyebrow + headline + sub-text use existing type scale; button reuses `partial('button')`
  with `variant => 'solid'` (accent pill).

## Out of scope

- No real image assets (placeholders only).
- No changes to other pages or to `cta.php`.
