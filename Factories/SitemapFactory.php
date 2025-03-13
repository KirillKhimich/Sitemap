<?php

namespace SitemapComponent\Factories;

use SitemapComponent\Services\Sitemaps;
/**
 * Базовый класс фабрик.
 */
abstract class SitemapFactory
{
    /**
     * Перегружаем в дочерних фабриках, для получения объекта необходимого сервиса для создания карты сайта.
     */
    abstract public function getSitemap() : Sitemaps;

    /**
     * Метод, который соответствует каждой отдельной фабрике, наследующей данную базовую фабрику.
     * @param string $filePath Имя файла.
     * @param array $content Массив страниц карты сайта.
     */

    public function create(string $filePath, array $content) : void
    {
       $sitemap = $this->getSitemap();
       $sitemap->createSitemap($filePath, $content);
    }
}