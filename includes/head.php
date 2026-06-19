<?php
require_once __DIR__ . '/helpers.php';

/**
 * Per-page meta can be set before including this file:
 *   $pageTitle, $pageDesc
 */
$pageTitle = $pageTitle ?? 'Dyneixa Solutions — Digital, Tech, Video, Design & Branding';
$pageDesc  = $pageDesc  ?? 'Dyneixa Solutions is a creative agency for digital marketing, tech solutions, video production, design and branding.';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDesc) ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind (CDN, no build step) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: '#CCEB00',
                        'accent-dark': '#A6C200',
                        cream: '#F5F5DC',
                        'cream-dark': '#E6E6C8',
                        surface: '#0A0A0A',
                        ink: '#111111',
                        muted: '#6B7280',
                    },
                    fontFamily: {
                        display: ['Asap', 'sans-serif'],
                        sans: ['Asap', 'sans-serif'],
                    },
                    borderRadius: {
                        pill: '999px',
                        card: '28px',
                    },
                    maxWidth: {
                        container: '1440px',
                    },
                },
            },
        };
    </script>

    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body class="bg-cream text-ink font-sans antialiased selection:bg-accent selection:text-ink overflow-x-hidden">
