<?php

namespace kirillkhimich\Sitemap;

class Config
{
    public const DEFAULT_SITEMAP_KEYS = [
        'loc' => 'loc',
        'lastmod' => 'lastmod',
        'priority' => 'priority',
        'changefreq' => 'changefreq'
    ];
    public const DEFAULT_FREQS = [
        'always',
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly',
        'never'
    ];

}