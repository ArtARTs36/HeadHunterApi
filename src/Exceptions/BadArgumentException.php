<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

use Throwable;

class BadArgumentException extends SendRequestException
{
    public function __construct($argument = "", $code = 0, Throwable $previous = null)
    {
        $message = "Bad argument '{$argument}'!";

        parent::__construct($message, $code, $previous);
    }
}
