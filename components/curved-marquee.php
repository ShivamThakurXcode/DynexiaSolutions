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
