<?php require_once __DIR__ . '/helpers.php'; ?>
<header id="site-header" class="fixed top-4 left-0 right-0 z-50 px-4 transition-all duration-300">
    <div class="mx-auto max-w-container">
        <nav class="flex items-center justify-between gap-4 rounded-pill bg-surface text-white pl-4 pr-2 py-2 shadow-lg shadow-black/10">
            <!-- Brand -->
            <a href="<?= url('index.php') ?>" class="flex items-center gap-2 pl-2 group">
                <span class="grid h-9 w-9 place-items-center rounded-full bg-white text-surface transition-transform duration-300 group-hover:rotate-90">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2l2.5 6.5L21 11l-6.5 2.5L12 20l-2.5-6.5L3 11l6.5-2.5L12 2z" fill="currentColor"/>
                    </svg>
                </span>
                <span class="font-display text-lg font-bold tracking-tight"></span>
            </a>

            <!-- Desktop nav -->
            <ul class="hidden md:flex items-center gap-7 text-sm font-medium">
                <?php foreach (site('nav') as $item): ?>
                    <li>
                        <a href="<?= url($item['href']) ?>"
                           class="text-white/80 hover:text-accent transition-colors <?= is_current($item['href']) ? 'text-accent' : '' ?>">
                            <?= e($item['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="flex items-center gap-2">
                <a href="<?= url('contact.php') ?>" data-magnetic
                   class="hidden sm:inline-flex items-center rounded-pill bg-accent px-5 py-2.5 text-sm font-semibold text-ink transition-transform hover:scale-[1.03]">
                    Book a Call
                </a>
                <!-- Mobile toggle -->
                <button id="nav-toggle" class="md:hidden grid h-10 w-10 place-items-center rounded-full bg-white/10 text-white" aria-label="Open menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden mt-2 rounded-card bg-surface text-white p-5">
            <ul class="flex flex-col gap-1">
                <?php foreach (site('nav') as $item): ?>
                    <li><a href="<?= url($item['href']) ?>" class="block rounded-xl px-4 py-3 text-base hover:bg-white/5 hover:text-accent transition-colors"><?= e($item['label']) ?></a></li>
                <?php endforeach; ?>
                <li class="mt-2"><a href="<?= url('contact.php') ?>" class="block rounded-pill bg-accent text-center px-4 py-3 text-base font-semibold text-ink">Book a Call</a></li>
            </ul>
        </div>
    </div>
</header>
