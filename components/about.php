<?php
/** About / approach section with a pinned-feeling stat panel. */
?>
<section id="about" class="py-24">
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
            <div>
                <?php partial('section-heading', [
                    'eyebrow' => 'About us',
                    'title'   => 'A partner, not<br>just a vendor.',
                    'align'   => 'left',
                ]); ?>
                <p class="mt-6 max-w-md text-muted" data-reveal="up">
                    Dyneixa Solutions blends strategy, design and engineering under one roof. We obsess over outcomes &mdash; not deliverables &mdash; and treat your goals as our own.
                </p>

                <div class="mt-8 space-y-4" data-reveal="up">
                    <?php
                    $points = [
                        'Senior team, no hand-offs to juniors',
                        'Transparent process and weekly demos',
                        'Design and engineering in lock-step',
                    ];
                    foreach ($points as $p):
                    ?>
                        <div class="flex items-center gap-3">
                            <span class="grid h-6 w-6 place-items-center rounded-full bg-accent text-ink text-xs">&#10003;</span>
                            <span class="text-ink/80"><?= e($p) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-9" data-reveal="up">
                    <?php partial('button', ['text' => 'Work with us', 'href' => url('contact.php'), 'variant' => 'dark', 'arrow' => true]); ?>
                </div>
            </div>

            <!-- dark stat panel -->
            <div class="rounded-card bg-surface p-10 text-white" data-reveal="scale">
                <div class="grid grid-cols-2 gap-8">
                    <?php
                    $cells = [
                        ['98%',  'Client retention'],
                        ['120+', 'Projects delivered'],
                        ['3.2x', 'Avg. ROI uplift'],
                        ['24/7', 'Support & care'],
                    ];
                    foreach ($cells as [$n, $l]):
                    ?>
                        <div>
                            <div class="font-display text-4xl md:text-5xl font-bold text-accent"><?= e($n) ?></div>
                            <div class="mt-2 text-sm text-white/60"><?= e($l) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-10 border-t border-white/10 pt-6 text-sm text-white/60">
                    &ldquo;They feel like an extension of our own team &mdash; fast, sharp and genuinely invested.&rdquo;
                </div>
            </div>
        </div>
    </div>
</section>
