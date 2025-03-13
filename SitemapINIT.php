<?php

namespace kirillkhimich\Sitemap;

use SitemapComponent\CustomEx\InvalidFileSystemException;
use SitemapComponent\Factories\SitemapFactory;

/**
 * Класс, инициирующий библиотеку.
 */
class SitemapINIT
{
    /**
     * Метод, инициирующий данную библиотеку, вызывает проверку на существование/возможность создания директории.
     * Вызываем метод $factory->create(), для каждого отдельного типа фабрики.
     * Все исключения, Выброшенные библиотекой, перехватываются в данном методе.
     * @param SitemapFactory $factory Передаем объект конкретной фабрики и происходит полиморфизм.
     * @param string $path Имя файла для создания.
     * @param array $content Массив страниц, которые мы хотим записать в файл.
     */

    public function init(SitemapFactory $factory, array $content, string $path): void
    {
        try
        {
            $this->createDir($path);
            $factory->create($path,$content);
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }
    }

    /**
     * Метод, проверяющий существование/возможность создания, а также возможность возможность записывания в директорию.
     * В случае невозможности перечисленного выбрасывает исключение, в связи с чем $this->init() не инициирует вызов
     * метода фабрики для создания объекта типа Sitemaps.
     * @param string $filePath Имя файла преобразуем в имя директории для проверки.
     * @throws InvalidFileSystemException
     */
    private function createDir(string $filePath): void
    {
        $dirname = dirname($filePath);
        if ((!is_dir($dirname) && !mkdir($dirname, 0755, true)) || !is_writable($dirname)) {
            throw new InvalidFileSystemException("Не хватает прав для создания или записи в директорию");
        }
    }
}