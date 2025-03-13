<?php

namespace kirillkhimich\Sitemap\CustomEx;

/**
 * Кастомное исключение, связанные с обработкой массива.
*/
class InvalidArrayException extends \Exception
{
    /**
     * Префиксное сообщение для подобных исключений.
     */
    private function prepareMessage(string $comment = ''): string
    {
        return $comment;
    }

    public function __construct(
        string $message,
        string $comment = "Произошла ошибка при парсинге массива: ",
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($this->prepareMessage($comment) . $message, $code, $previous);
    }
}
