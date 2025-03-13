<?php

namespace Sitemap\CustomEx;
/**
 * Кастомное исключение, связанное с работой с файловой системой.
 */
class InvalidFileSystemException extends \Exception
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
        string $comment = "Произошла ошибка при работе файловой системой: ",
        int $code = 0,
        \Throwable $previous = null
    )
    {
        parent::__construct($this->prepareMessage($comment) . $message, $code, $previous);
    }
}