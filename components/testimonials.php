<?php
/** Testimonials section. */
$quotes = [
    ['quote' => 'Dyneixa rebuilt our brand and our pipeline in the same quarter. The work speaks for itself.', 'name' => 'Sara Mihaylova', 'role' => 'CEO, NovaPay'],
    ['quote' => 'Finally an agency that moves at our speed. Sharp strategy, beautiful execution.', 'name' => 'Daniel Reyes', 'role' => 'Founder, Lumen'],
    ['quote' => 'They cut our release time by 70% without breaking a thing. Rare team.', 'name' => 'Ivo Petrov', 'role' => 'CTO, Orbit'],
    ['quote' => 'The launch film drove millions of views and actual signups. Worth every cent.', 'name' => 'Mia Larsson', 'role' => 'CMO, Verde'],
];
?>
<section class="px-4 py-24">
    <div class="mx-auto max-w-container">
        <?php partial('section-heading', [
            'eyebrow' => 'Testimonials',
            'title'   => 'Loved by the teams<br>we work with.',
        ]); ?>

        <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($quotes as $i => $q): $isDark = $i % 2 === 1; ?>
                <figure data-reveal="up" class="flex flex-col justify-between rounded-card p-7 <?= $isDark ? 'bg-surface text-white' : 'bg-white/60 text-ink border border-black/5' ?>">
                    <div class="text-accent-dark text-3xl font-display leading-none">&ldquo;</div>
                    <blockquote class="mt-3 text-sm leading-relaxed <?= $isDark ? 'text-white/80' : 'text-ink/80' ?>"><?= e($q['quote']) ?></blockquote>
                    <figcaption class="mt-6 flex items-center gap-3 pt-5 border-t <?= $isDark ? 'border-white/10' : 'border-black/10' ?>">
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-accent text-ink text-sm font-bold"><?= e(mb_substr($q['name'], 0, 1)) ?></span>
                        <span>
                            <span class="block text-sm font-semibold"><?= e($q['name']) ?></span>
                            <span class="block text-xs <?= $isDark ? 'text-white/50' : 'text-muted' ?>"><?= e($q['role']) ?></span>
                        </span>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
