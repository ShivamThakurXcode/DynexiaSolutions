<?php
/** FAQ accordion section. */
$faqs = dataset('faqs');
?>
<section class="py-24">
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
    <div class="mx-auto max-w-3xl">
        <div class="flex flex-col items-center text-center" data-reveal="up">
            <span class="inline-flex items-center rounded-pill border border-black/15 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-muted">FAQs</span>
            <h2 class="mt-5 font-display text-4xl md:text-5xl font-bold tracking-tight">FAQs</h2>
            <p class="mt-4 max-w-md text-muted">Everything you need to know about working with <?= e(site('brand')) ?> <?= e(site('tagline')) ?>.</p>
        </div>

        <div class="mt-12 space-y-3">
            <?php foreach ($faqs as $i => $faq): ?>
                <div class="faq-item rounded-2xl border border-black/10 bg-white/70 overflow-hidden" data-reveal="up">
                    <button type="button" class="faq-trigger flex w-full items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
                        <span class="font-medium text-ink"><?= e($faq['q']) ?></span>
                        <span class="faq-icon grid h-8 w-8 shrink-0 place-items-center rounded-full border border-black/15 text-ink transition-transform duration-300">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                        </span>
                    </button>
                    <div class="faq-panel grid grid-rows-[0fr] transition-all duration-300 ease-out">
                        <div class="overflow-hidden">
                            <p class="px-6 pb-5 text-sm leading-relaxed text-muted"><?= e($faq['a']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</section>
