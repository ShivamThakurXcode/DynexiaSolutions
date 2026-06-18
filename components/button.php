<?php
/**
 * Pill button / link.
 * Props: text, href (default '#'), variant (solid|dark|outline), magnetic (bool), arrow (bool), class
 */
$text     = $text     ?? 'Button';
$href     = $href     ?? '#';
$variant  = $variant  ?? 'solid';
$magnetic = $magnetic ?? false;
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
   class="group inline-flex items-center justify-center rounded-pill py-2 pl-6 text-sm font-semibold transition-all hover:scale-[1.02] <?= $arrow ? 'gap-2 pr-1.5' : 'gap-2 px-6 py-3' ?> <?= $styles ?> <?= e($class) ?>">
    <?= e($text) ?>
    <?php if ($arrow): ?>
        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full border border-dashed border-current transition-transform duration-300 group-hover:rotate-45">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M9 7h8v8"/></svg>
        </span>
    <?php endif; ?>
</a>
