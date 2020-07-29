<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Exceptions\BadArgumentException;
use ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler;
use ArtARTs36\HeadHunterApi\Exceptions\SendRequestException;
use ArtARTs36\HeadHunterApi\IO\Request;
use ArtARTs36\HeadHunterApi\IO\Response;
use ArtARTs36\HeadHunterApi\Tests\Traits\CallMethodViaReflection;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionHandlerTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
class ExceptionHandlerTest extends TestCase
{
    use CallMethodViaReflection;

    /**
     * @covers \ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler::handle
     */
    public function testHandle(): void
    {
        $handler = new ExceptionHandler();

        self::expectException(SendRequestException::class);

        $handler->handle(new Request('', ''), new Response(5, ''));
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler::handle
     * @throws SendRequestException
     */
    public function testBadArgument(): void
    {
        $handler = new ExceptionHandler();

        $message = json_encode([
            'description' => 'bad argument',
        ]);

        self::expectException(BadArgumentException::class);

        $handler->handle(new Request('', ''), new Response(5, $message));
    }
}
