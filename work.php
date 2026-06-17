<?php
require_once __DIR__ . '/includes/helpers.php';
$studies = dataset('case-studies');

// Build category filter list
$categories = ['All'];
foreach ($studies as $s) {
    if (!in_array($s['category'], $categories, true)) {
        $categories[] = $s['category'];
    }
}

$pageTitle = 'Case Studies — Dyneixa Solutions';
$pageDesc  = 'Selected work across branding, marketing, tech and video.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php partial('page-hero', [
        'eyebrow'  => 'Case studies',
        'title'    => 'Work that moved<br>the numbers.',
        'subtitle' => 'A look at the brands we\'ve helped design, build and scale.',
    ]); ?>

    <section class="pb-24">
        <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
            <!-- Filters -->
            <div class="flex flex-wrap gap-2" data-reveal="fade">
                <?php foreach ($categories as $i => $cat): ?>
                    <button data-filter="<?= e($cat) ?>"
                            class="filter-btn rounded-pill border border-black/15 px-5 py-2 text-sm font-medium transition-colors <?= $i === 0 ? 'bg-surface text-white border-surface' : 'text-ink hover:border-ink' ?>">
                        <?= e($cat) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2" data-filter-grid>
                <?php foreach ($studies as $cs): $isDark = $cs['color'] === '#0A0A0A'; ?>
                    <a href="<?= url('case-study.php?slug=' . urlencode($cs['slug'])) ?>"
                       data-reveal="up" data-category="<?= e($cs['category']) ?>"
                       class="filter-item group flex flex-col overflow-hidden rounded-card border border-black/5 transition-transform hover:-translate-y-1 <?= $isDark ? 'bg-surface text-white' : 'bg-white/60 text-ink' ?>">
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-105" style="background:<?= e($cs['color']) ?>"></div>
                            <div class="absolute inset-0 grid place-items-center">
                                <span class="font-display text-5xl md:text-6xl font-bold <?= $isDark ? 'text-accent' : 'text-ink/90' ?>"><?= e($cs['title']) ?></span>
                            </div>
                            <span class="absolute left-5 top-5 rounded-pill bg-black/70 px-3 py-1 text-xs font-medium text-white"><?= e($cs['category']) ?></span>
                            <span class="absolute right-5 top-5 text-xs font-medium text-white/80"><?= e($cs['year']) ?></span>
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

    <?php partial('cta'); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
