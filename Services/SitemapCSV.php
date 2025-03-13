<?php

namespace SitemapComponent\Services;

use SitemapComponent\Config;
use SitemapComponent\CustomEx\InvalidArrayException;
use SitemapComponent\CustomEx\InvalidFileSystemException;
use SitemapComponent\SitemapTypeConstraints;

/**
 * Сервис-создатель карты сайта формата CSV.
 */
class SitemapCSV extends Sitemaps
{
    /**
     * Принимает расширение файла, соответствующее данному формату карты сайта.
     * @param SitemapTypeConstraints $type
     * @see Sitemaps
    */
    public function __construct(
        private readonly SitemapTypeConstraints $type
    )
    {
    }

    /**
     * Метод-создатель карты сайта, соответствующий формату CSV, при успешной проверке создает карту сайта в формате CSV.
     * @param string $filePath
     * @param array $content
     * @throws InvalidFileSystemException
     * @throws InvalidArrayException
     */
    public function createSitemap(string $filePath, array $content) : bool
    {
        if ($this->isValidTypeFile($this->type,$filePath) && $this->isCreatableFile($filePath))
        {
            if ($this->isValidContents($content)) {
                if ($file = fopen($filePath, "a+")) {
                    fputcsv($file, Config::DEFAULT_SITEMAP_KEYS, ";");
                    foreach ($content as $row) {
                        fputcsv($file, $row, ";");
                    }
                    fclose($file);
                }
            }
            else
            {
                throw new InvalidFileSystemException("Не удалось записать данные в файл: $filePath");
            }
        }
        return true;
    }

}