<?php

namespace Sitemap\Factories;

use Sitemap\Services\SitemapJSON;
use Sitemap\Services\Sitemaps;
use Sitemap\SitemapTypeConstraints;

/**
 * Фабрика, соответствующая типу карты сайта JSON.
 * @see SitemapFactory
 */
class SitemapJSONFactory extends  SitemapFactory
{
    /**
     * Перегружаемый метод для получение объекта, соответствующему данному типу, передаем объекту ограничение его типа.
     * @see SitemapTypeConstraints
     */
    public function getSitemap(): Sitemaps
    {
        return new SitemapJSON(SitemapTypeConstraints::JSON);
    }

}