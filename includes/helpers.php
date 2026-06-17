<?php
/**
 * Tiny helper layer — bootstrap, escaping, asset/url resolution and the
 * partial() renderer that gives plain-PHP components scoped props.
 */

if (!defined('DYNEIXA_BOOT')) {
    define('DYNEIXA_BOOT', true);

    // Project root (this file lives in /includes)
    define('BASE_PATH', dirname(__DIR__));

    // Public base URL (handles being served from /d/ under XAMPP or from root)
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $scriptDir = rtrim($scriptDir, '/');
    define('BASE_URL', $scriptDir === '' ? '' : $scriptDir);

    // Load global site config once
    $GLOBALS['site'] = require BASE_PATH . '/config/site.php';
}

/** HTML-escape a string. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Build a URL relative to the app base. */
function url(string $path = ''): string
{
    $path = ltrim($path, '/');
    return BASE_URL . '/' . $path;
}

/** Build an asset URL. */
function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

/** Access the global site config. */
function site(?string $key = null)
{
    $site = $GLOBALS['site'] ?? [];
    if ($key === null) {
        return $site;
    }
    return $site[$key] ?? null;
}

/**
 * Render a component with scoped props.
 * Usage: partial('button', ['text' => 'Start Now', 'href' => '#']);
 */
function partial(string $name, array $data = []): void
{
    $file = BASE_PATH . '/components/' . $name . '.php';
    if (!is_file($file)) {
        echo "<!-- missing component: {$name} -->";
        return;
    }
    extract($data, EXTR_SKIP);
    include $file;
}

/** Load a data set from /data, returning an array. */
function dataset(string $name): array
{
    $file = BASE_PATH . '/data/' . $name . '.php';
    return is_file($file) ? (array) require $file : [];
}

/** Find a single record by slug within a dataset. */
function find_by_slug(string $name, ?string $slug): ?array
{
    if ($slug === null || $slug === '') {
        return null;
    }
    foreach (dataset($name) as $row) {
        if (($row['slug'] ?? null) === $slug) {
            return $row;
        }
    }
    return null;
}

/** Mark a nav item active when its href matches the current script. */
function is_current(string $href): bool
{
    $current = basename($_SERVER['SCRIPT_NAME'] ?? '');
    $target  = basename(parse_url($href, PHP_URL_PATH) ?? '');
    return $current !== '' && $current === $target;
}
