<?php

namespace SitemapComponent;

use DateTime;
use SitemapComponent\CustomEx\InvalidArrayException;
use SitemapComponent\Services\Sitemaps;

/**
 * Класс-хелпер для обработки поступающего массива страниц.
*/
class CheckingArrayHelper
{

    public function __construct(
        private readonly string $locationKey,
        private readonly string $lastModKey,
        private readonly string $priorityKey,
        private readonly string $freqKey,
        private readonly array $correctKeysArray,
        private readonly array $defaultFrequency,
        private readonly float $minPriority = 0,
        private readonly float $maxPriority = 1
    )
    {
    }

    /**
     * Проверка на строгое соответствие принимаемого массива.
     * @param array $contents Массив, принятый на проверку.
     * @throws InvalidArrayException
     * @see Sitemaps
     * @see Example.php Ожидается двумерный массив.
     */
    public function checkContents(array $contents) : bool
    {
        $this->checkNotEmptyArray($contents);

        foreach ($contents as $key => $content)
        {
            if (!is_array($content)) {
                throw new InvalidArrayException("элемент $key не является массивом, ожидается двумерным массив.");
            }

            if ($extra = array_keys(array_diff_key($content,$this->correctKeysArray)))
            {
                $extra = $extra[0];
                throw new InvalidArrayException("На странице $key передан неожиданный ключ: $extra.");

            }
            elseif($missing = array_keys(array_diff_key($this->correctKeysArray,$content)))
            {
                $missing = $missing[0];
                throw new InvalidArrayException("На странице $key отсутствует ключ: $missing.");
            }
            $this->checkValuesByPage($key,$content);
        }
        return true;
    }

    /**
     * Проверка на непустой массив.
     * @param array $contents
     * @return bool
     * @throws InvalidArrayException
     */
    public function checkNotEmptyArray(array $contents) : bool
    {
        if (empty($contents)) {
            throw new InvalidArrayException('Массив не может быть пустым');
        }
        return true;
    }

    /**
     * Метод-коллектор всех проверок значений страницы-массива.
     * @param mixed $keyPage Номер/название страницы
     * @param array $content Проверяемая страница
     * @throws InvalidArrayException
     */
    public function checkValuesByPage(mixed $keyPage, array $content) : void
    {
        $this->isValidLocValue($keyPage,$content);
        $this->isValidLastModValue($keyPage,$content);
        $this->isValidPriorityValue($keyPage,$content);
        $this->isValidFreqValue($keyPage,$content);
    }

    /**
     * Проверка значения ключа ['loc'] === Config::DEFAULT_SITEMAP_KEYS['loc'], каждой страницы-массива.
     * @throws InvalidArrayException
     */
    public function isValidLocValue(mixed $keyPage,array $content) : void
    {
        $locKey = $this->locationKey;

        if (is_string($content[$locKey]))
        {
            if (!filter_var(trim($content[$locKey]), FILTER_VALIDATE_URL))
            {
                throw new InvalidArrayException("Неверный формат URL: {$content["$locKey"]} на странице $keyPage");
            }
        }
        else
        {
            throw new InvalidArrayException("Передан некорректный тип $locKey на странице $keyPage");
        }
    }
    /**
     * Проверка значения ключа ['lastmod'] === Config::DEFAULT_SITEMAP_KEYS['lastmod'], каждой страницы-массива.
     * @throws InvalidArrayException
     */
    public function isValidLastModValue(mixed $keyPage,array $content) : void
    {
        $lastModKey = $this->lastModKey;
        if (is_string($content[$lastModKey]))
        {
            if (!self::isValidDateString($content[$lastModKey]) && !self::isValidDateString($content[$lastModKey], 'd-m-Y'))
            {
                throw new InvalidArrayException("Неверный формат даты для '{$content["$lastModKey"]}' на странице $keyPage");
            }
        }
        else
        {
            throw new InvalidArrayException("Передан некорректный тип $lastModKey на странице $keyPage");
        }
    }
    /**
     * Проверка значения ключа ['priority'] === Config::DEFAULT_SITEMAP_KEYS['priority'], каждой страницы-массива.
     * @throws InvalidArrayException
     */
    public function isValidPriorityValue(mixed $keyPage,array $content) : void
    {
        $priorityKey = $this->priorityKey;
        if (is_string(($content[$priorityKey])))
        {
            $content[$priorityKey] = $this->stringToFloat($content[$priorityKey]);
        }
        if (is_float($content[$priorityKey]))
        {
            if ($content[$priorityKey] < 0 || $content[$priorityKey] > 1) {
                throw new InvalidArrayException("Приоритет должен быть между $this->minPriority и $this->maxPriority на странице $keyPage");
            }
        }
        else
        {
            throw new InvalidArrayException("Передан некорректный тип $priorityKey на странице с номером $keyPage");
        }
    }
    /**
     * Проверка значения ключа ['changefreq'] === Config::DEFAULT_SITEMAP_KEYS['changefreq'], каждой страницы-массива.
     * $this->defaultFrequency === Config::DEFAULT_FREQS
     * @see Config
     * @throws InvalidArrayException
     */
    public function isValidFreqValue(mixed $keyPage,array $content)
    {
        $changefreqKey = $this->freqKey;
        if (is_string($content[$changefreqKey])) {

            if (!in_array($content[$changefreqKey], $this->defaultFrequency))
            {
                throw new InvalidArrayException("Неверное значение '$changefreqKey' на странице $keyPage");
            }
        }
        else
        {
            throw new InvalidArrayException("Передан некорректный тип $changefreqKey на странице $keyPage");
        }
    }

    /**
     * Саб-метод для self::isValidLastModValue.
     * @param String $date
     * @param string $format
     * @return bool
     */
    public function isValidDateString(String $date, string $format = 'Y-m-d') : bool
    {
        if (DateTime::createFromFormat($format, $date))
        {
         return true;
        }
        return false;
    }
    public function stringToFloat($string) : float|false
    {
            if (preg_match('/^[0-9]*\.?[0-9]+$/', $string)) {
                return(float) $string;
            }
            return false;
    }
}