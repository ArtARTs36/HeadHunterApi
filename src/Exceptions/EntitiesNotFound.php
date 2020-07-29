<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

use Throwable;

class EntitiesNotFound extends SendRequestException
{
    public function __construct($url, $code = 0, Throwable $previous = null)
    {
        $message = "In request '{$url}' not found entities";

        parent::__construct($message, $code, $previous);
    }
}
