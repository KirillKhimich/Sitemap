<?php

namespace SitemapComponent\Factories;

use SitemapComponent\Services\SitemapJSON;
use SitemapComponent\Services\Sitemaps;
use SitemapComponent\SitemapTypeConstraints;

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