<?php

namespace SitemapComponent\Factories;

use SitemapComponent\Services\SitemapCSV;
use SitemapComponent\Services\Sitemaps;
use SitemapComponent\SitemapTypeConstraints;

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