<?php

namespace Sitemap\Factories;

use Sitemap\Services\Sitemaps;
use Sitemap\Services\SitemapXML;
use Sitemap\SitemapTypeConstraints;

/**
 * Фабрика, соответствующая типу карты сайта XML.
 * @see SitemapFactory
 */
class SitemapXMLFactory extends  SitemapFactory
{
    /**
     * Перегружаемый метод для получение объекта, соответствующему данному типу, передаем объекту ограничение его типа.
     * @see SitemapTypeConstraints
     */
    public function getSitemap(): Sitemaps
    {
        return new SitemapXML(SitemapTypeConstraints::XML);
    }

}