<?php
/**
 * Reviews / Success Stories — exact 1:1 rebuild of the Formix Framer card.
 * Tokens taken from the source:
 *   card bg #F0F0F0, radius 20px, layered soft shadow
 *   info panel bg #E5E5E5, radius 16px, dashed 1px rgba(0,0,0,.2)
 *   avatar radius 30px, solid 1px #F0F0F0
 *   social btn radius 30px, dashed 1px rgba(0,0,0,.2), bg #F0F0F0, blur(10px)
 *   role text #4F4F4F
 */
$quotes = [
    ['quote' => 'Proactive, precise, and easy to work with - no hand-holding needed, just smooth collaboration from start to finish.', 'name' => 'Jared Kim',      'role' => 'Marketing Director',       'rating' => '4.9', 'social' => 'x',        'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'],
    ['quote' => 'Felt like an embedded team with zero friction; communication was clear, and revisions landed perfectly on the first go.', 'name' => 'Maya Collins',   'role' => 'Head of Product',          'rating' => '5.0', 'social' => 'linkedin', 'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg'],
    ['quote' => 'The quality was unmatched. We submitted our request on Monday and had polished designs by Wednesday.', 'name' => 'Jesse Leigh',     'role' => 'CEO & Founder',            'rating' => '4.9', 'social' => 'x',        'avatar' => 'https://randomuser.me/api/portraits/men/52.jpg'],
    ['quote' => 'We\'ve tried other design subscriptions - none compare to Dyneixa. Professional, reliable, and seriously creative.', 'name' => 'Benjamin Daul',  'role' => 'Head of Engineering',      'rating' => '4.9', 'social' => 'linkedin', 'avatar' => 'https://randomuser.me/api/portraits/men/65.jpg'],
    ['quote' => 'Dyneixa completely transformed the way we approach design. The turnaround time is insane and the output\'s always on-brand.', 'name' => 'Michael Joseph', 'role' => 'Head of Content',          'rating' => '5.0', 'social' => 'x',        'avatar' => 'https://randomuser.me/api/portraits/men/76.jpg'],
    ['quote' => 'It felt like an in-house design team. Communication was seamless, and revisions were spot on from the first pass.', 'name' => 'Amy Louise',      'role' => 'Customer Success Manager', 'rating' => '5.0', 'social' => 'linkedin', 'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg'],
];

/** Inline social glyph for the card corner (stroke #121212). */
function review_social(string $key): string
{
    $icons = [
        'x'        => '<path d="M4 4l16 16M20 4L4 20" stroke="#121212" stroke-width="2" stroke-linecap="round"/>',
        'linkedin' => '<path d="M6.5 8.5v9M6.5 5.5v.01M11 17.5v-5a2.5 2.5 0 015 0v5M11 17.5v-5" stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
    ];
    return $icons[$key] ?? '';
}
?>
<section>
    <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10 py-24">
        <!-- Section label + heading + intro -->
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between" data-reveal="up">
            <div>
                <span class="inline-flex items-center rounded-pill border border-black/15 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-muted">
                    / 007 / Reviews
                </span>
                <h2 class="mt-5 font-display text-4xl md:text-6xl font-bold leading-tight tracking-tight">
                    Success <span class="text-muted">Stories.</span>
                </h2>
            </div>
            <p class="max-w-sm text-muted">Discover how our design subscription helps innovative brands grow smarter and faster.</p>
        </div>

        <!-- Outer bordered box containing the grid -->
        <div class="mt-14 rounded-[28px] border border-black/10 bg-white/30 p-2 md:p-2" data-reveal="up">
        <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($quotes as $q): ?>
                <figure data-reveal="up"
                        class="flex border border-black/10 flex-col p-2.5"
                        style="background-color:#F0F0F0; border-radius:20px; box-shadow:0 0.602187px 0.602187px -0.916667px rgba(0,0,0,0.08), 0 2.28853px 2.28853px -1.83333px rgba(0,0,0,0.08), 0 10px 10px -2.75px rgba(0,0,0,0.07);">

                    <!-- Top: rating + quote + content -->
                    <div class="px-5 pt-5 pb-6">
                        <div class="flex items-start justify-between">
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-wide text-ink/80">
                                <?= e($q['rating']) ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="#F59E0B"><path d="M12 2l2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.8 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2z"/></svg>
                                <span class="text-muted">Rating</span>
                            </span>
                            <!-- quote mark SVG -->
                            <svg width="26" height="20" viewBox="0 0 26 20" fill="rgba(0,0,0,0.18)" aria-hidden="true">
                                <path d="M0 20V12C0 5.4 4 1 10.5 0L12 2.6C8.3 4 6.4 6.3 6 9.2H11V20H0ZM15 20V12C15 5.4 19 1 25.5 0L27 2.6C23.3 4 21.4 6.3 21 9.2H26V20H15Z"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-[15px] font-semibold leading-snug text-ink">
                            &quot;<?= e($q['quote']) ?>&quot;
                        </h3>
                    </div>

                    <!-- Info panel: dashed, bg #E5E5E5 -->
                    <div class="mt-auto flex items-center justify-between gap-3 p-2.5"
                         style="background-color:#E5E5E5; border-radius:16px; border:1px dashed rgba(0,0,0,0.2);">
                        <div class="flex items-center gap-3">
                            <!-- avatar: rounded square 30px, solid 1px #F0F0F0 -->
                            <img src="<?= e($q['avatar']) ?>" alt="<?= e($q['name']) ?>" loading="lazy"
                                 class="h-11 w-11 shrink-0 object-cover"
                                 style="border-radius:30px; border:1px solid #F0F0F0;">
                            <div class="leading-tight">
                                <p class="text-sm font-semibold text-ink"><?= e($q['name']) ?></p>
                                <p class="text-[11px]" style="color:#4F4F4F;"><?= e($q['role']) ?></p>
                            </div>
                        </div>

                        <!-- social btn: dashed, bg #F0F0F0, blur -->
                        <a href="#" aria-label="<?= e($q['social']) ?>"
                           class="grid h-10 w-10 shrink-0 place-items-center transition-transform hover:scale-105"
                           style="border-radius:30px; border:1px dashed rgba(0,0,0,0.2); background-color:#F0F0F0; backdrop-filter:blur(10px);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><?= review_social($q['social']) ?></svg>
                        </a>
                    </div>
                </figure>
            <?php endforeach; ?>
        </div>
        </div>
    </div>
</section>
