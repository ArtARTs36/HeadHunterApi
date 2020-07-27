<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

use Throwable;

class SendRequestException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
