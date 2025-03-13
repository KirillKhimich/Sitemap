<?php

namespace kirillkhimich\Sitemap;

use SitemapComponent\CustomEx\InvalidFileSystemException;
use SplFileInfo;

/**
 * Класс-хелпер для проверки файла перед записью.
*/
class CheckingFileHelper
{
    /**
     * Метод, проверяющий соответствие переданного расширения с расширением связаным с определенным типом карты сайта.
     * @param SitemapTypeConstraints $type Расширение привязанное к определенному типу карты сайта.
     * @param string $filePath Имя файла.
     * @throws InvalidFileSystemException
     */
    public static function checkFileExtension(SitemapTypeConstraints $type, string $filePath) : bool
    {

        $file = new SplFileInfo($filePath);

        if (strtolower($file->getExtension()) !== $type->value)
        {
            throw new InvalidFileSystemException("Некорректное расширение файла {$file->getFilename()}, ожидается расширение: $type->value");
        }
        return true;
    }

    /**
     * Мы уже проверили наличие прав на создание файла в заданой директории, но ошибки могут быть не связанны с правами.
     * @param string $filePath Имя файла.
     * @see SitemapINIT
     * @throws InvalidFileSystemException
     */
    public static function checkCreatableFile(string $filePath) : bool
    {
        if (!$file = fopen($filePath,"a+"))
        {
            throw new InvalidFileSystemException("Невозможно создать файл по иным причинам
            (недостаточно памяти,ограничение на количество файлов и\или пр.)");
        }else
        {
            fclose($file);
        }
        return true;
    }
}