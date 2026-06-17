<?php
require_once __DIR__ . '/includes/helpers.php';

$slug = $_GET['slug'] ?? '';
$post = find_by_slug('posts', $slug);

if ($post === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}

$pageTitle = $post['title'] . ' — Dyneixa Solutions';
$pageDesc  = $post['excerpt'];
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <article class="px-4 pt-40 md:pt-48 pb-24">
        <div class="mx-auto max-w-3xl">
            <a href="<?= url('blog.php') ?>" class="inline-flex items-center gap-2 text-sm text-muted hover:text-ink transition-colors" data-reveal="fade">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
                Back to blog
            </a>

            <span class="mt-6 block text-sm font-medium text-accent-dark" data-reveal="fade"><?= e($post['category']) ?></span>
            <h1 class="mt-3 font-display text-4xl md:text-5xl font-bold leading-tight tracking-tight" data-hero-title><?= e($post['title']) ?></h1>
            <div class="mt-5 flex items-center gap-3 text-sm text-muted" data-reveal="fade">
                <span><?= e($post['author']) ?></span><span>&middot;</span>
                <span><?= e($post['date']) ?></span><span>&middot;</span>
                <span><?= e($post['read']) ?></span>
            </div>

            <div class="mt-8 aspect-[21/9] overflow-hidden rounded-card bg-accent grid place-items-center p-8" data-reveal="scale">
                <span class="font-display text-3xl md:text-4xl font-bold text-ink/80 text-center"><?= e($post['title']) ?></span>
            </div>

            <div class="prose-dyneixa mt-10 space-y-6" data-reveal="up">
                <?php foreach ($post['body'] as $para): ?>
                    <p class="text-lg leading-relaxed text-ink/80"><?= e($para) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </article>

    <?php partial('cta', ['title' => 'Got a project in mind?']); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
