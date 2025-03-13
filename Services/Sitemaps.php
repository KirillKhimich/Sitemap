<?php

namespace SitemapComponent\Services;

use SitemapComponent\Config;
use SitemapComponent\CheckingArrayHelper;
use SitemapComponent\CheckingFileHelper;
use SitemapComponent\CustomEx\InvalidArrayException;
use SitemapComponent\CustomEx\InvalidFileSystemException;
use SitemapComponent\SitemapTypeConstraints;
/**
 * Абстрактный класс сервисов-создателей карт сайта.
 */
abstract class Sitemaps
{

    /**
     * Обязуем при создании объекта принимать ограничение на расширение, так как создание и проверка корректности файла
     * sitemap.* происходит на уровне сервиса.
     * @param SitemapTypeConstraints $type
     */
    abstract public function __construct(SitemapTypeConstraints $type);

    /**
     * Метод-контракт для дочерних сервисов, для возможности вызова в фабрике через общий тип.
     * @param string $filePath
     * @param array $contents
     */
    abstract public function createSitemap(string $filePath, array $contents);

    /**
     * Возвращаем true в случае успешной проверки массива.
     * @throws InvalidArrayException
     * @see CheckingArrayHelper
     */
    protected function isValidContents(array $contents) : bool
    {
        $array = new CheckingArrayHelper(
            Config::DEFAULT_SITEMAP_KEYS['loc'],
            Config::DEFAULT_SITEMAP_KEYS['lastmod'],
            Config::DEFAULT_SITEMAP_KEYS['priority'],
            Config::DEFAULT_SITEMAP_KEYS['changefreq'],
            Config::DEFAULT_SITEMAP_KEYS,
            Config::DEFAULT_FREQS);
        return $array->checkContents($contents);
    }
    /**
     * Возвращаем true в случае соответствия расширения SitemapTypeConstraints $type с расширением $filePath.
     * @throws InvalidFileSystemException
     * @see CheckingFileHelper
     */
    protected function isValidTypeFile(SitemapTypeConstraints $type, $filePath) : bool
    {
        return CheckingFileHelper::checkFileExtension($type,$filePath);
    }

    /**
     * Возвращаем true в случае возможности создания файла.
     * @throws InvalidFileSystemException
     * @see CheckingFileHelper
     */
    protected function isCreatableFile(string $fileName) : bool
    {
        return CheckingFileHelper::checkCreatableFile($fileName);
    }
}