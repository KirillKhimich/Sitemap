<?php

namespace SitemapComponent\Services;

use SitemapComponent\CustomEx\InvalidArrayException;
use SitemapComponent\CustomEx\InvalidFileSystemException;
use SitemapComponent\SitemapTypeConstraints;

/**
 * Сервис-создатель карты сайта формата JSON.
 */
class SitemapJSON extends Sitemaps
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
     * Метод-создатель карты сайта, соответствующий формату JSON, при успешной проверке создает карту сайта в формате JSON.
     * @param string $filePath
     * @param array $content
     * @throws InvalidFileSystemException
     * @throws InvalidArrayException
     */
    public function createSitemap(string $filePath, array $content) : bool
    {
        if ($this->isValidTypeFile($this->type,$filePath) && $this->isCreatableFile($filePath))
        {
            if ($this->isValidContents($content)){

                if ($jsonData = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE))
                {
                    throw new InvalidArrayException("Ошибка кодирования: " . json_last_error_msg());
                }
                if (file_put_contents($filePath,$jsonData)) {
                    throw new InvalidFileSystemException("Не удалось записать данные в файл: $filePath");
                }
            }
        }
        return true;
    }

}