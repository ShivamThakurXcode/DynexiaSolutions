<?php
require_once __DIR__ . '/includes/helpers.php';

$slug    = $_GET['slug'] ?? '';
$service = find_by_slug('services', $slug);

if ($service === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}

$pageTitle = $service['title'] . ' — Dyneixa Solutions';
$pageDesc  = $service['desc'];
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php partial('page-hero', [
        'eyebrow'  => 'Service',
        'title'    => e($service['title']) . '<br><span class="text-accent-dark">' . e($service['tagline']) . '</span>',
        'subtitle' => $service['desc'],
    ]); ?>

    <section class="px-4 pb-16">
        <div class="mx-auto max-w-container grid gap-12 lg:grid-cols-2 lg:items-start">
            <div data-reveal="up">
                <h2 class="font-display text-3xl font-bold">What's included</h2>
                <ul class="mt-6 space-y-4">
                    <?php foreach ($service['features'] as $f): ?>
                        <li class="flex items-start gap-3 rounded-2xl bg-white/60 border border-black/5 p-4">
                            <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-accent text-ink text-xs">&#10003;</span>
                            <span class="text-ink/80"><?= e($f) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div data-reveal="up">
                <h2 class="font-display text-3xl font-bold">How we work</h2>
                <div class="mt-6 space-y-4">
                    <?php foreach ($service['process'] as $i => $step): ?>
                        <div class="flex gap-4 rounded-2xl bg-surface text-white p-5">
                            <span class="font-display text-2xl font-bold text-accent">0<?= $i + 1 ?></span>
                            <div>
                                <h3 class="font-semibold"><?= e($step['title']) ?></h3>
                                <p class="mt-1 text-sm text-white/60"><?= e($step['desc']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php partial('cta', ['title' => 'Let\'s talk about ' . $service['title'] . '.']); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
