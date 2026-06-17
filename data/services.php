<?php
/**
 * Service offerings for Dyneixa Solutions.
 * Each entry powers the services grid, the /services overview and the
 * single service detail page (service.php?slug=).
 */

return [
    [
        'slug'     => 'digital-marketing',
        'title'    => 'Digital Marketing',
        'tagline'  => 'Growth engines that compound.',
        'desc'     => 'Performance marketing, SEO and content built to turn attention into revenue.',
        'icon'     => 'chart',
        'features' => [
            'Paid acquisition (Meta, Google, TikTok)',
            'SEO & content strategy',
            'Email & lifecycle automation',
            'Analytics, dashboards & attribution',
        ],
        'process' => [
            ['title' => 'Audit', 'desc' => 'We map your funnel, channels and unit economics.'],
            ['title' => 'Plan',  'desc' => 'A channel mix and roadmap tied to clear KPIs.'],
            ['title' => 'Launch','desc' => 'Campaigns go live with tight feedback loops.'],
            ['title' => 'Scale', 'desc' => 'Double down on what works, cut what doesn\'t.'],
        ],
    ],
    [
        'slug'     => 'tech-solutions',
        'title'    => 'Tech Solutions',
        'tagline'  => 'Software that ships and scales.',
        'desc'     => 'Web apps, platforms and integrations engineered for speed and reliability.',
        'icon'     => 'code',
        'features' => [
            'Web & product engineering',
            'API design & integrations',
            'Cloud, DevOps & automation',
            'Performance & security hardening',
        ],
        'process' => [
            ['title' => 'Discover', 'desc' => 'Requirements, architecture and scope.'],
            ['title' => 'Design',   'desc' => 'System design and technical blueprints.'],
            ['title' => 'Build',    'desc' => 'Iterative delivery with weekly demos.'],
            ['title' => 'Operate',  'desc' => 'Monitoring, support and continuous improvement.'],
        ],
    ],
    [
        'slug'     => 'video-production',
        'title'    => 'Video Production',
        'tagline'  => 'Stories that stop the scroll.',
        'desc'     => 'From concept to final cut — ads, brand films and social-first content.',
        'icon'     => 'play',
        'features' => [
            'Creative direction & scripting',
            'Production & on-set direction',
            'Editing, motion & sound design',
            'Short-form social cut-downs',
        ],
        'process' => [
            ['title' => 'Concept', 'desc' => 'Idea, script and storyboard.'],
            ['title' => 'Shoot',   'desc' => 'Production with a tight, capable crew.'],
            ['title' => 'Edit',    'desc' => 'Editing, color, motion and sound.'],
            ['title' => 'Deliver', 'desc' => 'Master plus platform-ready versions.'],
        ],
    ],
    [
        'slug'     => 'designing',
        'title'    => 'Designing',
        'tagline'  => 'Interfaces people love to use.',
        'desc'     => 'Product and web design that balances beauty with conversion.',
        'icon'     => 'pen',
        'features' => [
            'UX research & wireframing',
            'UI & design systems',
            'Web & landing page design',
            'Prototyping & handoff',
        ],
        'process' => [
            ['title' => 'Research', 'desc' => 'Users, goals and constraints.'],
            ['title' => 'Wireframe','desc' => 'Structure before surface.'],
            ['title' => 'Design',   'desc' => 'High-fidelity UI and systems.'],
            ['title' => 'Prototype','desc' => 'Interactive flows ready to build.'],
        ],
    ],
    [
        'slug'     => 'branding',
        'title'    => 'Branding',
        'tagline'  => 'Identities that mean something.',
        'desc'     => 'Strategy, identity and guidelines that make your brand unmistakable.',
        'icon'     => 'spark',
        'features' => [
            'Brand strategy & positioning',
            'Logo & visual identity',
            'Voice, messaging & naming',
            'Brand guidelines & assets',
        ],
        'process' => [
            ['title' => 'Strategy', 'desc' => 'Positioning, audience and promise.'],
            ['title' => 'Identity', 'desc' => 'Logo, type, color and system.'],
            ['title' => 'Apply',    'desc' => 'Identity across every touchpoint.'],
            ['title' => 'Guide',    'desc' => 'Guidelines so it stays consistent.'],
        ],
    ],
];
