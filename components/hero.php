<?php
/** Home hero. */
?>
<section class="relative pt-36 md:pt-44 pb-20 px-4 overflow-hidden">
    <!-- floating accent blob -->
    <div data-parallax data-parallax-speed="-60" class="pointer-events-none absolute -top-10 right-[-6rem] h-72 w-72 rounded-full bg-accent/40 blur-3xl"></div>
    <div data-parallax data-parallax-speed="40" class="pointer-events-none absolute bottom-0 left-[-6rem] h-72 w-72 rounded-full bg-accent/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-container text-center">
        <span class="inline-flex items-center gap-2 rounded-pill border border-black/10 bg-white/50 px-4 py-2 text-sm font-medium text-ink/70" data-reveal="fade">
            <span class="h-2 w-2 rounded-full bg-accent animate-pulse"></span>
            Creative agency &mdash; built for growth
        </span>

        <h1 class="mx-auto mt-7 max-w-4xl font-display text-5xl md:text-7xl font-bold leading-[1.05] tracking-tight" data-hero-title>
            We design, build &amp; scale
            <span class="text-accent-dark">brands that move.</span>
        </h1>

        <p class="mx-auto mt-6 max-w-xl text-lg text-muted" data-reveal="fade">
            Digital marketing, tech, video, design and branding &mdash; one team to take your brand from idea to impact.
        </p>

        <div class="mt-9 flex flex-wrap items-center justify-center gap-3" data-reveal="up">
            <?php partial('button', ['text' => 'Book a Call', 'href' => url('contact.php'), 'variant' => 'dark', 'arrow' => true]); ?>
            <?php partial('button', ['text' => 'View Our Work', 'href' => url('work.php'), 'variant' => 'outline']); ?>
        </div>

        <!-- stat strip -->
        <div class="mx-auto mt-16 grid max-w-3xl grid-cols-2 gap-6 sm:grid-cols-4" data-reveal="up">
            <?php
            $stats = [
                ['120+', 'Projects shipped'],
                ['40+',  'Happy clients'],
                ['5',    'Core services'],
                ['9yrs', 'Of experience'],
            ];
            foreach ($stats as [$n, $l]):
            ?>
                <div class="text-center sm:text-left">
                    <div class="font-display text-3xl md:text-4xl font-bold"><?= e($n) ?></div>
                    <div class="mt-1 text-sm text-muted"><?= e($l) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- trusted-by marquee -->
<div class="border-y border-black/10 py-5">
    <?php partial('marquee', [
        'items' => ['NovaPay', 'Lumen', 'Orbit', 'Verde', 'Atlas', 'Pulse', 'Vertex', 'Halo'],
        'speed' => 28,
        'class' => 'text-xl md:text-2xl font-display font-medium',
    ]); ?>
</div>
