<?php
/** Services section for the home page. */
$services = dataset('services');
?>
<section id="services" class="py-24">
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <?php partial('section-heading', [
                'eyebrow'  => 'Services',
                'title'    => 'Everything your brand<br>needs to grow.',
                'align'    => 'left',
            ]); ?>
            <p class="max-w-sm text-muted" data-reveal="up">Five disciplines, one team. We plug in wherever you need us &mdash; or run the whole show.</p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($services as $i => $svc): ?>
                <?php partial('service-card', $svc + ['index' => $i, 'dark' => ($i % 3 === 1)]); ?>
            <?php endforeach; ?>

            <!-- CTA tile -->
            <a href="<?= url('services.php') ?>" data-reveal="up"
               class="group flex flex-col justify-between rounded-card bg-accent p-8 text-ink transition-transform hover:-translate-y-1">
                <span class="grid h-14 w-14 place-items-center rounded-2xl bg-ink text-accent">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </span>
                <div class="mt-10">
                    <h3 class="font-display text-2xl font-bold">See all services</h3>
                    <p class="mt-3 text-sm text-ink/70">Explore what we do in detail and find the right fit.</p>
                </div>
            </a>
        </div>
    </div>
</section>
