<?php

namespace kirillkhimich\Sitemap\Factories;

use kirillkhimich\Sitemap\Services\SitemapCSV;
use kirillkhimich\Sitemap\Services\Sitemaps;
use kirillkhimich\Sitemap\SitemapTypeConstraints;

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