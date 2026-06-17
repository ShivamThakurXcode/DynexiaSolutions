<?php
/**
 * Service card.
 * Props: slug, title, desc, icon, features (array), index (int), dark (bool)
 */
$slug     = $slug     ?? '';
$title    = $title    ?? '';
$desc     = $desc     ?? '';
$icon     = $icon     ?? 'spark';
$features = $features ?? [];
$index    = $index    ?? 0;
$dark     = $dark     ?? false;

$icons = [
    'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
    'code'  => '<path d="M9 7l-5 5 5 5M15 7l5 5-5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
    'play'  => '<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M10 9l5 3-5 3V9z" fill="currentColor"/>',
    'pen'   => '<path d="M4 20l4-1L19 8a2 2 0 00-3-3L5 16l-1 4z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>',
    'spark' => '<path d="M12 3l2 6 6 2-6 2-2 6-2-6-6-2 6-2 2-6z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>',
];
$iconSvg = $icons[$icon] ?? $icons['spark'];

$cardCls = $dark
    ? 'bg-surface text-white'
    : 'bg-white/60 text-ink border border-black/5';
$badgeCls = $dark ? 'bg-accent text-ink' : 'bg-accent text-ink';
?>
<a href="<?= url('service.php?slug=' . urlencode($slug)) ?>"
   data-reveal="up"
   class="group relative flex flex-col justify-between overflow-hidden rounded-card p-8 transition-all duration-300 hover:-translate-y-1 <?= $cardCls ?>">
    <div class="flex items-start justify-between">
        <span class="grid h-14 w-14 place-items-center rounded-2xl <?= $badgeCls ?>">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><?= $iconSvg ?></svg>
        </span>
        <span class="font-display text-sm <?= $dark ? 'text-white/40' : 'text-muted' ?>">0<?= (int)$index + 1 ?></span>
    </div>

    <div class="mt-10">
        <h3 class="font-display text-2xl font-bold"><?= e($title) ?></h3>
        <p class="mt-3 text-sm <?= $dark ? 'text-white/60' : 'text-muted' ?>"><?= e($desc) ?></p>

        <ul class="mt-5 space-y-2 text-sm">
            <?php foreach (array_slice($features, 0, 3) as $f): ?>
                <li class="flex items-center gap-2 <?= $dark ? 'text-white/70' : 'text-ink/70' ?>">
                    <span class="grid h-4 w-4 place-items-center rounded-full bg-accent text-ink text-[10px]">&#10003;</span>
                    <?= e($f) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <span class="mt-8 inline-flex items-center gap-2 text-sm font-semibold <?= $dark ? 'text-accent' : 'text-accent-dark' ?>">
        Learn more
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </span>
</a>
