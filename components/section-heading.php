<?php
/**
 * Eyebrow + heading + subtitle block.
 * Props: eyebrow, title, subtitle, align (left|center), dark (bool)
 */
$eyebrow  = $eyebrow  ?? null;
$title    = $title    ?? '';
$subtitle = $subtitle ?? null;
$align    = $align    ?? 'center';
$dark     = $dark     ?? false;

$alignCls = $align === 'left' ? 'text-left items-start' : 'text-center items-center mx-auto';
$titleCls = $dark ? 'text-white' : 'text-ink';
$subCls   = $dark ? 'text-white/60' : 'text-muted';
?>
<div class="flex flex-col <?= $alignCls ?> max-w-2xl" data-reveal="up">
    <?php if ($eyebrow): ?>
        <span class="inline-flex items-center gap-2 text-sm font-medium text-accent-dark">
            <span class="h-2 w-2 rounded-full bg-accent"></span><?= e($eyebrow) ?>
        </span>
    <?php endif; ?>
    <h2 class="mt-4 font-display text-4xl md:text-5xl font-bold leading-tight tracking-tight <?= $titleCls ?>">
        <?= $title /* allow inline markup */ ?>
    </h2>
    <?php if ($subtitle): ?>
        <p class="mt-4 text-base md:text-lg <?= $subCls ?>"><?= e($subtitle) ?></p>
    <?php endif; ?>
</div>
