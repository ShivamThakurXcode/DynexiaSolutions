<?php
/**
 * Featured case studies strip.
 * Props: limit (int)
 */
$limit = $limit ?? 4;
$items = array_slice(dataset('case-studies'), 0, $limit);
?>
<section id="work">
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10 py-24">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <?php partial('section-heading', [
                'eyebrow' => 'Case studies',
                'title'   => 'Work we\'re<br>proud of.',
                'align'   => 'left',
            ]); ?>
            <?php partial('button', ['text' => 'All case studies', 'href' => url('work.php'), 'variant' => 'outline']); ?>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-2">
            <?php foreach ($items as $cs): $isDark = $cs['color'] === '#0A0A0A'; ?>
                <a href="<?= url('case-study.php?slug=' . urlencode($cs['slug'])) ?>" data-reveal="up"
                   class="group flex flex-col overflow-hidden rounded-card border border-black/5 transition-transform hover:-translate-y-1 <?= $isDark ? 'bg-surface text-white' : 'bg-white/60 text-ink' ?>">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-105" style="background:<?= e($cs['color']) ?>"></div>
                        <div class="absolute inset-0 grid place-items-center">
                            <span class="font-display text-5xl md:text-6xl font-bold <?= $isDark ? 'text-accent' : 'text-ink/90' ?>"><?= e($cs['title']) ?></span>
                        </div>
                        <span class="absolute left-5 top-5 rounded-pill bg-black/70 px-3 py-1 text-xs font-medium text-white"><?= e($cs['category']) ?></span>
                    </div>
                    <div class="flex items-center justify-between gap-4 p-7">
                        <div>
                            <h3 class="font-display text-xl font-bold"><?= e($cs['title']) ?></h3>
                            <p class="mt-2 text-sm <?= $isDark ? 'text-white/60' : 'text-muted' ?>"><?= e($cs['summary']) ?></p>
                        </div>
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-accent text-ink transition-transform group-hover:rotate-45">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M9 7h8v8"/></svg>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
