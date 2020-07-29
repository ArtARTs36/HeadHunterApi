<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

use Throwable;

class RequestMethodNotAllowed extends \LogicException
{
    public function __construct($method, $code = 0, Throwable $previous = null)
    {
        $message = "Request Method is \"{$method}\" not allowed!";

        parent::__construct($message, $code, $previous);
    }
}
