<?php
require_once __DIR__ . '/includes/helpers.php';

// --- Form handling -----------------------------------------------------------
$sent   = false;
$errors = [];
$values = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $k => $_) {
        $values[$k] = trim($_POST[$k] ?? '');
    }
    if ($values['name'] === '')                                   $errors['name']    = 'Please enter your name.';
    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))     $errors['email']   = 'Please enter a valid email.';
    if ($values['message'] === '')                                $errors['message'] = 'Tell us a little about your project.';

    if (!$errors) {
        // TODO: wire to a real mailer (PHP mail(), SMTP, or a form service).
        // For now we just acknowledge a successful submission.
        $sent   = true;
        $values = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];
    }
}

$pageTitle = 'Contact — Book a Call — Dyneixa Solutions';
$pageDesc  = 'Tell us about your project and let\'s build something that moves.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <?php partial('page-hero', [
        'eyebrow'  => 'Contact',
        'title'    => 'Let\'s build something<br>that moves.',
        'subtitle' => 'Tell us where you want to go — we\'ll map the fastest way there.',
    ]); ?>

    <section class="px-4 pb-24">
        <div class="mx-auto max-w-container grid gap-12 lg:grid-cols-12">
            <!-- Info -->
            <div class="lg:col-span-5" data-reveal="up">
                <div class="rounded-card bg-surface p-8 text-white">
                    <h2 class="font-display text-2xl font-bold">Get in touch</h2>
                    <p class="mt-3 text-white/60">Prefer email or a quick call? We usually reply within one business day.</p>

                    <div class="mt-8 space-y-5">
                        <a href="mailto:<?= e(site('contact')['email']) ?>" class="flex items-center gap-4 group">
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-white/10 text-accent">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                            </span>
                            <span>
                                <span class="block text-xs uppercase tracking-wide text-white/40">Email</span>
                                <span class="text-sm group-hover:text-accent transition-colors"><?= e(site('contact')['email']) ?></span>
                            </span>
                        </a>
                        <a href="tel:<?= e(site('contact')['phone']) ?>" class="flex items-center gap-4 group">
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-white/10 text-accent">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-3 2a14 14 0 006 6l2-3 5 2v4a2 2 0 01-2 2A17 17 0 013 6a2 2 0 012-2z"/></svg>
                            </span>
                            <span>
                                <span class="block text-xs uppercase tracking-wide text-white/40">Phone</span>
                                <span class="text-sm group-hover:text-accent transition-colors"><?= e(site('contact')['phone']) ?></span>
                            </span>
                        </a>
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-6">
                        <p class="text-xs uppercase tracking-wide text-white/40">Follow us</p>
                        <div class="mt-3 flex gap-2">
                            <?php foreach (site('socials') as $s): ?>
                                <a href="<?= e($s['href']) ?>" aria-label="<?= e($s['label']) ?>" class="grid h-10 w-10 place-items-center rounded-full border border-white/15 hover:bg-accent hover:text-ink hover:border-accent transition-colors">
                                    <span class="text-xs font-semibold"><?= e(mb_substr($s['label'], 0, 1)) ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-7" data-reveal="up">
                <?php if ($sent): ?>
                    <div class="rounded-card border border-accent/40 bg-accent/15 p-10 text-center">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-accent text-ink text-2xl">&#10003;</div>
                        <h2 class="mt-5 font-display text-2xl font-bold">Thanks — message received!</h2>
                        <p class="mt-2 text-muted">We'll get back to you within one business day.</p>
                    </div>
                <?php endif; ?>

                <form method="post" class="rounded-card bg-white/60 border border-black/5 p-8 <?= $sent ? 'mt-6' : '' ?>" novalidate>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium">Name</label>
                            <input type="text" name="name" value="<?= e($values['name']) ?>"
                                   class="mt-2 w-full rounded-2xl border border-black/15 bg-white/70 px-4 py-3 text-sm focus:border-ink focus:outline-none">
                            <?php if (isset($errors['name'])): ?><p class="mt-1 text-xs text-red-600"><?= e($errors['name']) ?></p><?php endif; ?>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" value="<?= e($values['email']) ?>"
                                   class="mt-2 w-full rounded-2xl border border-black/15 bg-white/70 px-4 py-3 text-sm focus:border-ink focus:outline-none">
                            <?php if (isset($errors['email'])): ?><p class="mt-1 text-xs text-red-600"><?= e($errors['email']) ?></p><?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium">Company <span class="text-muted font-normal">(optional)</span></label>
                        <input type="text" name="company" value="<?= e($values['company']) ?>"
                               class="mt-2 w-full rounded-2xl border border-black/15 bg-white/70 px-4 py-3 text-sm focus:border-ink focus:outline-none">
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium">Project details</label>
                        <textarea name="message" rows="5"
                                  class="mt-2 w-full rounded-2xl border border-black/15 bg-white/70 px-4 py-3 text-sm focus:border-ink focus:outline-none"><?= e($values['message']) ?></textarea>
                        <?php if (isset($errors['message'])): ?><p class="mt-1 text-xs text-red-600"><?= e($errors['message']) ?></p><?php endif; ?>
                    </div>

                    <button type="submit" data-magnetic
                            class="mt-7 inline-flex items-center gap-2 rounded-pill bg-surface px-7 py-3.5 text-sm font-semibold text-white hover:bg-ink transition-colors">
                        Send message
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M9 7h8v8"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
