<?php
require_once __DIR__ . '/helpers.php';

/** Inline SVG for a social icon key. */
function social_icon(string $key): string
{
    $icons = [
        'x'         => '<path d="M4 4l16 16M20 4L4 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
        'linkedin'  => '<path d="M6.5 8.5v9M6.5 5.5v.01M11 17.5v-5a2.5 2.5 0 015 0v5M11 17.5v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
        'dribbble'  => '<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M5 8c5 2 9 5 11 11M19 8c-6 0-11 2-14 6M9 3c4 5 5 11 4 18" stroke="currentColor" stroke-width="1.6"/>',
        'instagram' => '<rect x="4" y="4" width="16" height="16" rx="5" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="2"/><circle cx="16.5" cy="7.5" r="1" fill="currentColor"/>',
        'youtube'   => '<rect x="3" y="6" width="18" height="12" rx="4" stroke="currentColor" stroke-width="2"/><path d="M11 9.5l4 2.5-4 2.5v-5z" fill="currentColor"/>',
    ];
    return $icons[$key] ?? '';
}

$ctaItems = [];
for ($i = 0; $i < 6; $i++) {
    $ctaItems[] = 'Book An Intro Call';
}
?>
<footer class="relative bg-cream overflow-hidden">
    <!-- dashed grid frame: left + right vertical rules aligned to the container -->
    <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true">
        <div class="mx-auto h-full max-w-container border-x border-dashed border-black/20"></div>
    </div>

    <div class="relative z-10">
        <!-- top dashed divider -->
        <div class="border-t border-dashed border-black/20"></div>

        <!-- CTA marquee band -->
        <a href="<?= url('contact.php') ?>" class="block max-w-[1440px] mx-auto hover:bg-ink/5 border-b border-dashed border-black/20 py-6 group">
            <div class="marquee" data-marquee data-speed="22">
                <div class="marquee__track font-display text-5xl md:text-7xl font-bold text-ink whitespace-nowrap">
                    <?php for ($r = 0; $r < 2; $r++): ?>
                        <span class="marquee__group inline-flex items-center">
                            <?php foreach ($ctaItems as $item): ?>
                                <span class="px-6 group-hover:text-accent-dark transition-colors"><?= e($item) ?></span>
                                <span class="text-3xl md:text-5xl">&#10005;</span>
                            <?php endforeach; ?>
                        </span>
                    <?php endfor; ?>
                </div>
            </div>
        </a>

        <!-- Columns row -->
        <div class="mx-auto max-w-container px-6 md:px-10 py-16">
            <div class="grid gap-12 md:grid-cols-12">
                <!-- Newsletter -->
                <div class="md:col-span-5" data-reveal="up">
                    <h3 class="font-display text-2xl font-bold">Newsletter</h3>
                    <p class="mt-3 max-w-xs text-sm text-muted">Stay updated with design trends, new templates, and subscription insights.</p>

                    <form class="mt-6 max-w-sm" data-newsletter>
                        <div class="flex items-center gap-2 rounded-pill border border-dashed border-black/30 bg-white/40 p-1.5 pl-5 focus-within:border-ink transition-colors">
                            <input type="email" name="email" required placeholder="Your Email"
                                   class="w-full bg-transparent text-sm text-ink placeholder:text-muted focus:outline-none">
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 rounded-pill bg-surface px-5 py-2.5 text-sm font-semibold text-white hover:bg-ink transition-colors">
                                Send
                                <span class="grid h-7 w-7 place-items-center rounded-full border border-dashed border-current">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M9 7h8v8"/></svg>
                                </span>
                            </button>
                        </div>
                        <p class="mt-3 hidden text-sm font-medium text-accent-dark" data-newsletter-success>Thanks — you're on the list. &#10003;</p>
                    </form>

                    <p class="mt-8 text-xs font-medium uppercase tracking-wider text-muted">/Follow Us</p>
                    <div class="mt-3 flex items-center gap-2">
                        <?php foreach (site('socials') as $s): ?>
                            <a href="<?= e($s['href']) ?>" aria-label="<?= e($s['label']) ?>"
                               class="grid h-10 w-10 place-items-center rounded-full border border-dashed border-black/30 text-ink hover:bg-accent hover:border-accent transition-colors">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><?= social_icon($s['icon']) ?></svg>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="md:col-span-2 md:col-start-7" data-reveal="up">
                    <p class="text-xs font-medium uppercase tracking-wider text-muted">/Navigation</p>
                    <ul class="mt-4 space-y-3 text-sm">
                        <?php foreach (site('footer_nav') as $item): ?>
                            <li><a href="<?= url($item['href']) ?>" class="hover:text-accent-dark transition-colors"><?= e($item['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="md:col-span-2" data-reveal="up">
                    <p class="text-xs font-medium uppercase tracking-wider text-muted">/Resources</p>
                    <ul class="mt-4 space-y-3 text-sm">
                        <?php foreach (site('footer_resources') as $item): ?>
                            <li><a href="<?= url($item['href']) ?>" class="hover:text-accent-dark transition-colors"><?= e($item['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="md:col-span-2" data-reveal="up">
                    <p class="text-xs font-medium uppercase tracking-wider text-muted">/Contact</p>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="mailto:<?= e(site('contact')['email']) ?>" class="hover:text-accent-dark transition-colors"><?= e(site('contact')['email']) ?></a></li>
                        <li><a href="tel:<?= e(site('contact')['phone']) ?>" class="hover:text-accent-dark transition-colors"><?= e(site('contact')['phone']) ?></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- dashed divider above wordmark -->
        <div class="border-t border-dashed border-black/20"></div>

        <!-- Giant wordmark -->
        <div class="px-4 py-10 select-none max-w-[1440px] mx-auto" aria-hidden="true">
            <h2 data-glitch
                class="font-display w-full font-bold leading-[0.8] text-ink text-center tracking-tighter"
               
                data-text="<?= e(strtoupper(site('brand'))) ?>">
                <?= e(strtoupper(site('brand'))) ?>
            </h2>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-dashed border-black/20">
            <div class="mx-auto max-w-container px-6 md:px-10 py-5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs uppercase tracking-wide text-muted">
                <span>&copy;<?= date('Y') ?> <?= e(strtoupper(site('brand'))) ?>. Designed by Dyneixa.</span>
                <span>Built with PHP + GSAP</span>
            </div>
        </div>
    </div>
</footer>
