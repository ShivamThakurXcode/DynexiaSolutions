<?php require_once __DIR__ . '/helpers.php'; ?>
<header id="site-header" class="fixed top-0 left-0 right-0 z-50 bg-cream border-b border-dashed border-black/20 transition-all duration-300">
    <div class="mx-auto max-w-container px-4">
        <nav class="flex items-center justify-between gap-4 py-4">
            <!-- Brand -->
            <a href="<?= url('index.php') ?>" class="flex items-center gap-2.5 group">
                <span class="grid h-8 w-8 place-items-center rounded-md bg-ink text-white transition-transform duration-300 group-hover:rotate-90">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 5l14 14M19 5L5 19"/>
                    </svg>
                </span>
                <span class="font-display text-xl font-bold tracking-tight"><?= e(site('brand')) ?></span>
            </a>

            <!-- Desktop nav -->
            <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
                <?php foreach (site('nav') as $item): ?>
                    <li>
                        <a href="<?= url($item['href']) ?>"
                           class="text-ink/80 hover:text-ink transition-colors <?= is_current($item['href']) ? 'text-ink' : '' ?>">
                            <?= e($item['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="flex items-center gap-2">
                <a href="<?= url('contact.php') ?>"
                   class="hidden sm:inline-flex items-center gap-2 rounded-pill bg-surface px-5 py-2.5 text-sm font-semibold text-white transition-transform hover:scale-[1.03]">
                    Book a Call
                    <span class="grid h-7 w-7 place-items-center rounded-full border border-dashed border-current">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M7 17L17 7M9 7h8v8"/></svg>
                    </span>
                </a>
                <!-- Mobile toggle -->
                <button id="nav-toggle" class="md:hidden grid h-10 w-10 place-items-center rounded-full bg-ink/5 text-ink" aria-label="Open menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden border-t border-dashed border-black/20 bg-cream px-4 py-4">
        <ul class="flex flex-col gap-1">
            <?php foreach (site('nav') as $item): ?>
                <li><a href="<?= url($item['href']) ?>" class="block rounded-xl px-4 py-3 text-base text-ink hover:bg-ink/5 transition-colors"><?= e($item['label']) ?></a></li>
            <?php endforeach; ?>
            <li class="mt-2"><a href="<?= url('contact.php') ?>" class="block rounded-pill bg-surface text-center px-4 py-3 text-base font-semibold text-white">Book a Call</a></li>
        </ul>
    </div>
</header>
