<?php

namespace kirillkhimich\Sitemap\Services;

use DOMDocument;
use kirillkhimich\Sitemap\CustomEx\InvalidArrayException;
use kirillkhimich\Sitemap\CustomEx\InvalidFileSystemException;
use kirillkhimich\Sitemap\SitemapTypeConstraints;

/**
 * Сервис-создатель карты сайта формата XML.
 */
class SitemapXML extends Sitemaps
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
     * Метод-создатель карты сайта, соответствующий формату XML, при успешной проверке создает карту сайта в формате XML.
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

                $dom = new DOMDocument('1.0', 'UTF-8');
                $dom->formatOutput = true;
                $urlset = $dom->createElement('urlset');
                $urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
                $urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
                $dom->appendChild($urlset);

                foreach ($content as $item) {
                    $urlElement = $dom->createElement('url');
                    foreach ($item as $key => $value) {
                        $element = $dom->createElement($key, htmlspecialchars($value));
                        $urlElement->appendChild($element);
                    }
                    $urlset->appendChild($urlElement);
                }

                if ($dom->save($filePath)) {
                    throw new InvalidFileSystemException("Не удалось записать данные в файл: $filePath");
                }
            }
        }
        return true;
    }

}