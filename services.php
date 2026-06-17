<?php
require_once __DIR__ . '/includes/helpers.php';
$services  = dataset('services');
$pageTitle = 'Services — Dyneixa Solutions';
$pageDesc  = 'Digital marketing, tech solutions, video production, design and branding.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php partial('page-hero', [
        'eyebrow'  => 'Services',
        'title'    => 'What we do, and<br>how we do it.',
        'subtitle' => 'Five disciplines that work together to move your brand forward.',
    ]); ?>

    <section class="pb-24">
        <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($services as $i => $svc): ?>
                <?php partial('service-card', $svc + ['index' => $i, 'dark' => ($i % 3 === 1)]); ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?php partial('cta'); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
