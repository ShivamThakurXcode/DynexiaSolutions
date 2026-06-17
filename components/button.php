<?php
/**
 * Pill button / link.
 * Props: text, href (default '#'), variant (solid|dark|outline), magnetic (bool), arrow (bool), class
 */
$text     = $text     ?? 'Button';
$href     = $href     ?? '#';
$variant  = $variant  ?? 'solid';
$magnetic = $magnetic ?? true;
$arrow    = $arrow    ?? false;
$class    = $class    ?? '';

$variants = [
    'solid'   => 'bg-accent text-ink hover:bg-accent-dark',
    'dark'    => 'bg-surface text-white hover:bg-ink',
    'outline' => 'border border-ink/20 text-ink hover:border-ink',
];
$styles = $variants[$variant] ?? $variants['solid'];
?>
<a href="<?= e($href) ?>" <?= $magnetic ? 'data-magnetic' : '' ?>
   class="inline-flex items-center justify-center gap-2 rounded-pill px-6 py-3 text-sm font-semibold transition-all hover:scale-[1.02] <?= $styles ?> <?= e($class) ?>">
    <?= e($text) ?>
    <?php if ($arrow): ?>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M9 7h8v8"/></svg>
    <?php endif; ?>
</a>
