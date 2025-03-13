<?php

namespace Sitemap\Factories;

use Sitemap\Services\SitemapCSV;
use Sitemap\Services\Sitemaps;
use Sitemap\SitemapTypeConstraints;

/**
 * Фабрика, соответствующая типу карты сайта CSV.
 * @see SitemapFactory
 */
class SitemapCSVFactory extends  SitemapFactory
{
    /**
     * Перегружаемый метод для получение объекта, соответствующему данному типу, передаем объекту ограничение его типа.
     * @see SitemapTypeConstraints
     */
    public function getSitemap(): Sitemaps
    {
        return new SitemapCSV(SitemapTypeConstraints::CSV);
    }

}