<?php

namespace SitemapComponent\Factories;

use SitemapComponent\Services\Sitemaps;
use SitemapComponent\Services\SitemapXML;
use SitemapComponent\SitemapTypeConstraints;

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