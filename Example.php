<?php
$sitePages = [
    [
        'loc' => 'https://example.com/',
        'lastmod' => '10-02-2023',
        'priority' => '0',
        'changefreq' => 'weekly'
    ],
    [
        'loc' => 'https://example.com/about',
        'priority' => '0.8',
        'changefreq' => 'weekly',
        'extraField' => 'лишнее поле' // лишний ключ
    ],
    [
        'loc' => 'https://example.com/products',
        'lastmod' => '2025-03-05',
        'priority' => '0.9',
        // changefreq отсутствует
        'asdasdasda' => "asdasd"
    ],
    2
];
$sitePages2 = [
    [
        'loc' => 'https://example.com/',
        'lastmod' => '2025-03-10',
        'priority' => '1.0',
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://example.com/',
        'lastmod' => '2025-03-10',
        'priority' => '1.0',
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://example.com/',
        'lastmod' => '2025-03-10',
        'priority' => '1.0',
        'changefreq' => 'daily'
    ],
];
$sitePages1 = [
    'loc' => 'https://example.com/',
    'lastmod' => '2025-03-10',
    'priority' => '1.0',
    'changefreq' => 'daily'
];
