<?php
require_once __DIR__ . '/includes/helpers.php';
if (!headers_sent()) {
    http_response_code(404);
}
$pageTitle = 'Page not found — Dyneixa Solutions';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main class="grid min-h-screen place-items-center px-4 pt-32 pb-24">
    <div class="text-center">
        <p class="font-display text-[8rem] md:text-[12rem] font-bold leading-none tracking-tighter text-ink" data-hero-title>404</p>
        <h1 class="mt-2 font-display text-2xl font-bold">This page took a different route.</h1>
        <p class="mt-3 text-muted">The page you're looking for doesn't exist or has moved.</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <?php partial('button', ['text' => 'Back home', 'href' => url('index.php'), 'variant' => 'dark', 'arrow' => true]); ?>
            <?php partial('button', ['text' => 'Book a Call', 'href' => url('contact.php'), 'variant' => 'outline']); ?>
        </div>
    </div>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
