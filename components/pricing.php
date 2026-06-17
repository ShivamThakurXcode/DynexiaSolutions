<?php
/** Pricing section — mirrors the reference layout (light + dark cards). */
$tiers = [
    [
        'name'    => 'Starter',
        'badge'   => 'Basic',
        'desc'    => 'Small businesses starting their social presence',
        'price'   => '3,990€',
        'dark'    => false,
        'features'=> [
            'Social brand audit',
            '3–4 posts per week',
            'Basic content strategy',
            'Platform management (1–2 platforms)',
        ],
    ],
    [
        'name'    => 'Growth',
        'badge'   => 'Premium',
        'desc'    => 'Scaling brands that want momentum',
        'price'   => '5,990€',
        'dark'    => true,
        'features'=> [
            'Everything in Starter',
            'Daily posting & engagement',
            'Paid ads setup & management',
            'Monthly strategy & reporting',
        ],
    ],
    [
        'name'    => 'Scale',
        'badge'   => 'Enterprise',
        'desc'    => 'Full-service partnership across every channel',
        'price'   => 'Custom',
        'dark'    => false,
        'features'=> [
            'Everything in Growth',
            'Dedicated team & strategist',
            'Video production & creative',
            'Full-funnel growth program',
        ],
    ],
];
?>
<section id="pricing" class="px-4 py-24">
    <div class="mx-auto max-w-container">
        <?php partial('section-heading', [
            'eyebrow'  => 'Pricing',
            'title'    => 'Simple pricing.<br>Scalable growth.',
            'subtitle' => 'Choose a plan that fits your stage — and scale as you grow.',
        ]); ?>

        <div class="mt-14 grid gap-6 lg:grid-cols-3">
            <?php foreach ($tiers as $t):
                $isDark = $t['dark'];
                $cardCls = $isDark ? 'bg-surface text-white' : 'bg-white/70 text-ink border border-black/5';
                $badgeCls = $isDark ? 'bg-white text-ink' : 'bg-accent text-ink';
            ?>
                <div data-reveal="up" class="flex flex-col rounded-card p-8 <?= $cardCls ?> <?= $isDark ? 'lg:-mt-4 lg:mb-4 shadow-xl shadow-black/20' : '' ?>">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-display text-2xl font-bold"><?= e($t['name']) ?></h3>
                            <p class="mt-2 text-sm <?= $isDark ? 'text-white/60' : 'text-muted' ?>"><?= e($t['desc']) ?></p>
                        </div>
                        <span class="rounded-pill px-3 py-1 text-xs font-semibold <?= $badgeCls ?>"><?= e($t['badge']) ?></span>
                    </div>

                    <p class="mt-7 text-sm font-semibold">Features included:</p>
                    <ul class="mt-4 space-y-3 text-sm">
                        <?php foreach ($t['features'] as $f): ?>
                            <li class="flex items-center gap-3">
                                <span class="grid h-5 w-5 place-items-center rounded-full <?= $isDark ? 'bg-white text-ink' : 'bg-surface text-white' ?> text-[10px]">&#10003;</span>
                                <?= e($f) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="mt-8 flex items-center justify-between gap-4 pt-6 border-t <?= $isDark ? 'border-white/10' : 'border-black/10' ?>">
                        <div>
                            <span class="font-display text-3xl font-bold"><?= e($t['price']) ?></span>
                            <?php if ($t['price'] !== 'Custom'): ?><span class="text-sm <?= $isDark ? 'text-white/50' : 'text-muted' ?>">/month</span><?php endif; ?>
                        </div>
                    </div>
                    <a href="<?= url('contact.php') ?>" data-magnetic
                       class="mt-5 inline-flex items-center justify-center rounded-pill px-6 py-3.5 text-sm font-semibold transition-all hover:scale-[1.02] <?= $isDark ? 'bg-accent text-ink' : 'bg-surface text-white' ?>">
                        Start Now
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
