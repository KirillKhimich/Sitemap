<?php

namespace kirillkhimich\Sitemap\Factories;

use kirillkhimich\Sitemap\Services\SitemapJSON;
use kirillkhimich\Sitemap\Services\Sitemaps;
use kirillkhimich\Sitemap\SitemapTypeConstraints;

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