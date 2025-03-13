<?php

namespace Sitemap;

/**
 * Ограничение расширений файлов для каждого типа файла карты сайта.
*/
enum SitemapTypeConstraints : string
{
    case JSON = "json";

    case XML = "xml";
    case CSV = "csv";
}
