<?php
/**
 * Big CTA band.
 * Props: title, text, button
 */
$title  = $title  ?? 'Ready to build something that moves?';
$text   = $text   ?? 'Tell us where you want to go. We\'ll map the fastest way to get there.';
$button = $button ?? 'Book a Call';
?>
<section class="px-4 py-24">
    <div class="mx-auto max-w-container">
        <div class="relative overflow-hidden rounded-card bg-surface px-6 py-16 md:px-16 md:py-24 text-center" data-reveal="scale">
            <div data-parallax data-parallax-speed="-40" class="pointer-events-none absolute -top-16 -right-16 h-64 w-64 rounded-full bg-accent/30 blur-3xl"></div>
            <div data-parallax data-parallax-speed="50" class="pointer-events-none absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-accent/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="font-display text-4xl md:text-6xl font-bold text-white leading-tight"><?= e($title) ?></h2>
                <p class="mt-5 text-lg text-white/60"><?= e($text) ?></p>
                <div class="mt-9 flex flex-wrap items-center justify-center gap-3">
                    <?php partial('button', ['text' => $button, 'href' => url('contact.php'), 'variant' => 'solid', 'arrow' => true]); ?>
                    <?php partial('button', ['text' => 'See pricing', 'href' => url('index.php#pricing'), 'variant' => 'outline', 'class' => 'text-white border-white/20 hover:border-white']); ?>
                </div>
            </div>
        </div>
    </div>
</section>
