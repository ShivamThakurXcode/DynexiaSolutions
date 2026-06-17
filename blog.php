<?php
require_once __DIR__ . '/includes/helpers.php';
$posts = dataset('posts');
$pageTitle = 'Blog — Dyneixa Solutions';
$pageDesc  = 'Notes on branding, marketing, design and building things that grow.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php partial('page-hero', [
        'eyebrow'  => 'Blog',
        'title'    => 'Ideas worth<br>sharing.',
        'subtitle' => 'Thinking on brand, growth, design and the craft of building.',
    ]); ?>

    <section class="pb-24">
        <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
            <?php $featured = $posts[0] ?? null; if ($featured): ?>
                <a href="<?= url('post.php?slug=' . urlencode($featured['slug'])) ?>" data-reveal="up"
                   class="group grid overflow-hidden rounded-card border border-black/5 bg-white/60 md:grid-cols-2">
                    <div class="relative aspect-[16/10] md:aspect-auto overflow-hidden bg-accent">
                        <div class="absolute inset-0 grid place-items-center p-8">
                            <span class="font-display text-3xl md:text-4xl font-bold text-ink/80 text-center"><?= e($featured['title']) ?></span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center p-8 md:p-12">
                        <span class="text-sm font-medium text-accent-dark"><?= e($featured['category']) ?> &middot; Featured</span>
                        <h2 class="mt-3 font-display text-3xl font-bold group-hover:text-accent-dark transition-colors"><?= e($featured['title']) ?></h2>
                        <p class="mt-3 text-muted"><?= e($featured['excerpt']) ?></p>
                        <span class="mt-5 text-sm text-muted"><?= e($featured['date']) ?> &middot; <?= e($featured['read']) ?></span>
                    </div>
                </a>
            <?php endif; ?>

            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach (array_slice($posts, 1) as $post): ?>
                    <a href="<?= url('post.php?slug=' . urlencode($post['slug'])) ?>" data-reveal="up"
                       class="group flex flex-col overflow-hidden rounded-card border border-black/5 bg-white/60 transition-transform hover:-translate-y-1">
                        <div class="relative aspect-[16/10] overflow-hidden bg-surface">
                            <div class="absolute inset-0 grid place-items-center p-6">
                                <span class="font-display text-xl font-bold text-accent text-center"><?= e($post['title']) ?></span>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-7">
                            <span class="text-xs font-medium text-accent-dark"><?= e($post['category']) ?></span>
                            <h3 class="mt-2 font-display text-lg font-bold group-hover:text-accent-dark transition-colors"><?= e($post['title']) ?></h3>
                            <p class="mt-2 text-sm text-muted"><?= e($post['excerpt']) ?></p>
                            <span class="mt-auto pt-5 text-xs text-muted"><?= e($post['date']) ?> &middot; <?= e($post['read']) ?></span>
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
