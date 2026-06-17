<?php
/**
 * Inner-page hero band.
 * Props: eyebrow, title, subtitle
 */
$eyebrow  = $eyebrow  ?? null;
$title    = $title    ?? '';
$subtitle = $subtitle ?? null;
?>
<section class="relative overflow-hidden pt-40 md:pt-48 pb-16">
    <div data-parallax data-parallax-speed="-40" class="pointer-events-none absolute -top-10 right-[-5rem] h-64 w-64 rounded-full bg-accent/30 blur-3xl"></div>
    <div class="relative mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
        <?php if ($eyebrow): ?>
            <span class="inline-flex items-center gap-2 text-sm font-medium text-accent-dark" data-reveal="fade">
                <span class="h-2 w-2 rounded-full bg-accent"></span><?= e($eyebrow) ?>
            </span>
        <?php endif; ?>
        <h1 class="mt-4 max-w-3xl font-display text-5xl md:text-6xl font-bold leading-tight tracking-tight" data-hero-title><?= $title ?></h1>
        <?php if ($subtitle): ?>
            <p class="mt-5 max-w-xl text-lg text-muted" data-reveal="fade"><?= e($subtitle) ?></p>
        <?php endif; ?>
    </div>
</section>
