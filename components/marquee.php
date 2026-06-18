<?php
/**
 * Reusable scrolling marquee.
 * Props: items (array of strings), speed (number), sep (string), dark (bool), class
 */
$items = $items ?? [];
$speed = $speed ?? 30;
$sep   = $sep   ?? '&#9679;';
$dark  = $dark  ?? false;
$class = $class ?? 'text-2xl md:text-3xl font-display font-semibold';
// default colour + hover colour (hover turns the text dark)
$color      = $dark ? 'text-white/80' : 'text-ink/70';
$hoverColor = $dark ? 'group-hover:text-white' : 'group-hover:text-ink';
?>
<div class="mx-auto max-w-[1440px] px-6 md:px-10">
    <div class="marquee group mx-auto max-w-[1440px] <?= $dark ? 'bg-surface' : '' ?>" data-marquee data-speed="<?= e($speed) ?>">
        <div class="marquee__track whitespace-nowrap <?= $class ?> <?= $color ?> <?= $hoverColor ?> transition-colors duration-300">
            <?php for ($r = 0; $r < 2; $r++): ?>
                <span class="marquee__group inline-flex items-center">
                    <?php foreach ($items as $item): ?>
                        <span class="px-6"><?= e($item) ?></span>
                        <span class="text-accent-dark"><?= $sep ?></span>
                    <?php endforeach; ?>
                </span>
            <?php endfor; ?>
        </div>
    </div>
</div>
