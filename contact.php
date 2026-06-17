<?php
require_once __DIR__ . '/includes/helpers.php';

// --- Form handling -----------------------------------------------------------
$sent   = false;
$errors = [];
$values = ['name' => '', 'email' => '', 'website' => '', 'budget' => '', 'message' => ''];

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
        $values = ['name' => '', 'email' => '', 'website' => '', 'budget' => '', 'message' => ''];
    }
}

$budgets = ['$3,000–$5,000', '$5,000–$10,000', '$10,000–$25,000', '$25,000+'];

$pageTitle = 'Contact — Get In Touch — Dyneixa Solutions';
$pageDesc  = 'Got questions or ready to start your project? Let\'s bring your ideas to life.';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<main>
    <!-- Get In Touch -->
    <section class="pt-40 md:pt-48 pb-12">
        <div class="mx-auto max-w-container border-x border-dashed border-black/20 px-6 md:px-10 grid gap-12 lg:grid-cols-2 lg:items-start">
            <!-- Left: heading + contact cards -->
            <div>
                <span class="inline-flex items-center rounded-pill border border-black/15 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-muted" data-reveal="fade">Contact</span>
                <h1 class="mt-5 font-display text-5xl md:text-6xl font-bold leading-tight tracking-tight" data-hero-title>
                    Get In <span class="text-muted">Touch.</span>
                </h1>
                <p class="mt-5 max-w-sm text-muted" data-reveal="fade">Got questions or ready to start your project? Let's bring your ideas to life.</p>

                <div class="mt-10 space-y-4 max-w-md">
                    <a href="mailto:<?= e(site('contact')['email']) ?>" data-reveal="up"
                       class="block rounded-2xl border border-black/10 bg-white/70 p-6 hover:border-ink/40 transition-colors">
                        <span class="text-xs font-medium uppercase tracking-wider text-muted">/Chat to Sales</span>
                        <span class="mt-2 block text-lg font-semibold"><?= e(site('contact')['email']) ?></span>
                    </a>
                    <a href="tel:<?= e(site('contact')['phone']) ?>" data-reveal="up"
                       class="block rounded-2xl border border-black/10 bg-white/70 p-6 hover:border-ink/40 transition-colors">
                        <span class="text-xs font-medium uppercase tracking-wider text-muted">/Call Us</span>
                        <span class="mt-2 block text-lg font-semibold"><?= e(site('contact')['phone']) ?></span>
                    </a>
                </div>
            </div>

            <!-- Right: dark form card -->
            <div data-reveal="up">
                <?php if ($sent): ?>
                    <div class="mb-4 rounded-2xl border border-accent/40 bg-accent/15 p-5 text-center">
                        <span class="font-semibold text-ink">Thanks — message received! We'll reply within one business day.</span>
                    </div>
                <?php endif; ?>

                <form method="post" novalidate class="rounded-card bg-surface p-7 md:p-9 text-white">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-medium uppercase tracking-wider text-white/50">/Your Name *</label>
                            <input type="text" name="name" value="<?= e($values['name']) ?>" placeholder="Your name"
                                   class="mt-2 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm placeholder:text-white/30 focus:border-accent focus:outline-none">
                            <?php if (isset($errors['name'])): ?><p class="mt-1 text-xs text-red-400"><?= e($errors['name']) ?></p><?php endif; ?>
                        </div>

                        <div>
                            <label class="block text-xs font-medium uppercase tracking-wider text-white/50">/E-Mail *</label>
                            <input type="email" name="email" value="<?= e($values['email']) ?>" placeholder="Your Email"
                                   class="mt-2 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm placeholder:text-white/30 focus:border-accent focus:outline-none">
                            <?php if (isset($errors['email'])): ?><p class="mt-1 text-xs text-red-400"><?= e($errors['email']) ?></p><?php endif; ?>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-medium uppercase tracking-wider text-white/50">/Website</label>
                                <input type="text" name="website" value="<?= e($values['website']) ?>" placeholder="Your Website"
                                       class="mt-2 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm placeholder:text-white/30 focus:border-accent focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-medium uppercase tracking-wider text-white/50">/Budget</label>
                                <select name="budget"
                                        class="mt-2 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm text-white/80 focus:border-accent focus:outline-none">
                                    <option value="" class="text-ink">Select budget</option>
                                    <?php foreach ($budgets as $b): ?>
                                        <option value="<?= e($b) ?>" class="text-ink" <?= $values['budget'] === $b ? 'selected' : '' ?>><?= e($b) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium uppercase tracking-wider text-white/50">/Message *</label>
                            <textarea name="message" rows="4" placeholder="Your Message"
                                      class="mt-2 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm placeholder:text-white/30 focus:border-accent focus:outline-none resize-none"><?= e($values['message']) ?></textarea>
                            <?php if (isset($errors['message'])): ?><p class="mt-1 text-xs text-red-400"><?= e($errors['message']) ?></p><?php endif; ?>
                        </div>

                        <button type="submit" data-magnetic
                                class="w-full rounded-pill bg-white px-6 py-4 text-sm font-semibold text-ink hover:bg-accent transition-colors">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php partial('faqs'); ?>
</main>
<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
