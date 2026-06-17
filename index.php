<?php
require_once __DIR__ . '/includes/helpers.php';
$pageTitle = 'Dyneixa Solutions — We design, build & scale brands that move.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php
    partial('hero');
    partial('services-grid');
    partial('about');
    partial('case-studies', ['limit' => 4]);
    partial('pricing');
    partial('testimonials');
    partial('cta');
    ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
