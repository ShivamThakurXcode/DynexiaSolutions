<?php
require_once __DIR__ . '/includes/helpers.php';

$slug = $_GET['slug'] ?? '';
$cs   = find_by_slug('case-studies', $slug);

if ($cs === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}

$pageTitle = $cs['title'] . ' — Case Study — Dyneixa Solutions';
$pageDesc  = $cs['summary'];
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <section class="px-4 pt-40 md:pt-48 pb-12">
        <div class="mx-auto max-w-container">
            <a href="<?= url('work.php') ?>" class="inline-flex items-center gap-2 text-sm text-muted hover:text-ink transition-colors" data-reveal="fade">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
                All case studies
            </a>
            <div class="mt-6 flex flex-wrap items-center gap-3" data-reveal="fade">
                <span class="rounded-pill bg-accent px-3 py-1 text-xs font-semibold text-ink"><?= e($cs['category']) ?></span>
                <span class="text-sm text-muted"><?= e($cs['year']) ?> &middot; <?= e($cs['client']) ?></span>
            </div>
            <h1 class="mt-5 font-display text-5xl md:text-7xl font-bold tracking-tight" data-hero-title><?= e($cs['title']) ?></h1>
            <p class="mt-5 max-w-2xl text-lg text-muted" data-reveal="fade"><?= e($cs['summary']) ?></p>
        </div>
    </section>

    <!-- hero visual -->
    <section class="px-4 pb-16">
        <div class="mx-auto max-w-container">
            <div class="relative aspect-[21/9] overflow-hidden rounded-card" data-reveal="scale">
                <div class="absolute inset-0" style="background:<?= e($cs['color']) ?>"></div>
                <div class="absolute inset-0 grid place-items-center">
                    <span class="font-display text-7xl md:text-9xl font-bold <?= $cs['color'] === '#0A0A0A' ? 'text-accent' : 'text-ink/90' ?>"><?= e($cs['title']) ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- results -->
    <section class="px-4 pb-16">
        <div class="mx-auto max-w-container grid gap-6 sm:grid-cols-3" data-reveal="up">
            <?php foreach ($cs['results'] as $r): ?>
                <div class="rounded-card bg-surface p-8 text-white text-center">
                    <div class="font-display text-4xl md:text-5xl font-bold text-accent"><?= e($r['value']) ?></div>
                    <div class="mt-2 text-sm text-white/60"><?= e($r['label']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- narrative -->
    <section class="px-4 pb-24">
        <div class="mx-auto max-w-container grid gap-12 lg:grid-cols-2">
            <div data-reveal="up">
                <h2 class="font-display text-2xl font-bold">The challenge</h2>
                <p class="mt-4 text-ink/80 leading-relaxed"><?= e($cs['problem']) ?></p>
            </div>
            <div data-reveal="up">
                <h2 class="font-display text-2xl font-bold">Our approach</h2>
                <p class="mt-4 text-ink/80 leading-relaxed"><?= e($cs['approach']) ?></p>
                <div class="mt-6 flex flex-wrap gap-2">
                    <?php foreach ($cs['services'] as $svc): ?>
                        <span class="rounded-pill border border-black/15 px-4 py-1.5 text-sm"><?= e($svc) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php partial('cta', ['title' => 'Want results like ' . $cs['title'] . '?']); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
