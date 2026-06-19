<?php
/**
 * Services section — large alternating rows.
 * Each row: numbered eyebrow, big title, description, a "What's included"
 * tag row (from each service's `features`), and a glossy image panel.
 * Powered by data/services.php.
 */
$services = dataset('services');
?>
<section id="services" class="bg-cream">
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10 py-24">
        <!-- Section header -->
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between" data-reveal="up">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-pill border border-dashed border-black/30 px-3 py-1 text-xs font-medium uppercase tracking-wider text-muted">
                    / 003 / Services
                </span>
                <h2 class="mt-6 font-display text-5xl md:text-7xl font-bold leading-[0.95] tracking-tight">
                    One Subscription,<br>
                    <span class="text-muted">Every Discipline.</span>
                </h2>
            </div>
            <p class="max-w-xs text-sm text-muted md:text-right">
                We combine strategy, speed, and skill to deliver exceptional design &mdash; every time.
            </p>
        </div>

        <!-- Service rows -->
        <div class="mt-16 space-y-6">
            <?php foreach ($services as $i => $svc): ?>
                <?php $reverse = ($i % 2 === 1); ?>
                <div class="rounded-[32px] border border-black/10 bg-white/40 p-2" data-reveal="up">
                <article class="group grid gap-2 lg:grid-cols-2">
                    <!-- Text side -->
                    <div class="flex flex-col rounded-[26px] border border-black/10 bg-white/70 p-8 md:p-10 <?= $reverse ? 'lg:order-2' : '' ?>">
                        <span class="inline-flex w-fit items-center rounded-pill border border-dashed border-black/30 px-3 py-1 text-xs font-medium uppercase tracking-wider text-muted">
                            <?= sprintf('%03d', $i + 1) ?> / <?= e($svc['title']) ?>
                        </span>

                        <h3 class="mt-6 font-display text-2xl md:text-3xl font-bold text-ink">
                            <?= e($svc['tagline']) ?>
                        </h3>
                        <p class="mt-3 max-w-md text-sm md:text-base text-muted">
                            <?= e($svc['desc']) ?>
                        </p>

                        <!-- What's included -->
                        <div class="mt-auto pt-10">
                            <p class="text-sm font-semibold text-ink">What's included</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <?php foreach (($svc['features'] ?? []) as $feature): ?>
                                    <span class="inline-flex items-center rounded-pill border border-dashed border-black/30 bg-white/40 px-3 py-1 text-[11px] font-medium uppercase tracking-wide text-ink/80">
                                        <?= e($feature) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Image / glossy panel side -->
                    <div class="relative min-h-[280px] overflow-hidden rounded-[26px] bg-ink lg:min-h-[420px] <?= $reverse ? 'lg:order-1' : '' ?>">
                        <div class="absolute inset-0"
                             style="background:
                                radial-gradient(120% 80% at 70% 20%, rgba(255,255,255,0.18), transparent 60%),
                                radial-gradient(90% 60% at 30% 90%, rgba(204,235,0,0.10), transparent 60%),
                                linear-gradient(135deg, #1a1a1a 0%, #050505 100%);"></div>
                        <!-- subtle accent glow line, echoing the reference render -->
                        <div class="absolute left-[55%] top-[42%] h-1.5 w-16 -translate-y-1/2 rounded-full bg-red-500/80 blur-[2px]"></div>
                        <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-105"></div>
                    </div>
                </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
