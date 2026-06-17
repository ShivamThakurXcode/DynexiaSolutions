<?php
/**
 * Generic rounded card wrapper.
 * Props: dark (bool), class, body (HTML string)
 */
$dark  = $dark  ?? false;
$class = $class ?? '';
$body  = $body  ?? '';
$base  = $dark ? 'bg-surface text-white' : 'bg-white/60 text-ink border border-black/5';
?>
<div data-reveal="up" class="rounded-card p-8 <?= $base ?> <?= e($class) ?>">
    <?= $body ?>
</div>
