<?php
/**
 * Global site configuration for Dyneixa Solutions.
 * Drives brand, navigation, socials and contact info across header & footer.
 */

return [
    'name'    => 'Dyneixa',
    'brand'   => 'Dyneixa',
    'tagline' => 'Solutions',
    'domain'  => 'dyneixa.com',

    'contact' => [
        'email' => 'hello@dyneixa.com',
        'phone' => '+359-123-45678',
    ],

    // Primary navigation (header)
    'nav' => [
        ['label' => 'About',        'href' => 'index.php#about'],
        ['label' => 'Services',     'href' => 'services.php'],
        ['label' => 'Case Studies', 'href' => 'work.php'],
        ['label' => 'Blog',         'href' => 'blog.php'],
    ],

    // Footer link columns
    'footer_nav' => [
        ['label' => 'Home',     'href' => 'index.php'],
        ['label' => 'Projects', 'href' => 'work.php'],
        ['label' => 'Contact',  'href' => 'contact.php'],
    ],
    'footer_resources' => [
        ['label' => 'Privacy Policy',   'href' => '#'],
        ['label' => 'Terms of Service', 'href' => '#'],
        ['label' => '404 Page',         'href' => 'does-not-exist'],
    ],

    // Social links — icon keys map to inline SVGs in footer.php
    'socials' => [
        ['label' => 'X',         'icon' => 'x',         'href' => '#'],
        ['label' => 'LinkedIn',  'icon' => 'linkedin',  'href' => '#'],
        ['label' => 'Dribbble',  'icon' => 'dribbble',  'href' => '#'],
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => '#'],
        ['label' => 'YouTube',   'icon' => 'youtube',   'href' => '#'],
    ],
];
