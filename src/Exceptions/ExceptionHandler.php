<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

use ArtARTs36\HeadHunterApi\IO\Request;
use ArtARTs36\HeadHunterApi\IO\Response;

class ExceptionHandler
{
    public function handle(Request $request, Response $response): void
    {
        if (is_string($response->content()) &&
            ($json = json_decode($response->content(), true)) &&
            ($desc = $json['description'])) {
            $this->byDescription($desc, $json, $request);
        }

        throw new SendRequestException();
    }

    private function byDescription(string $description, array $json, Request $request): void
    {
        switch ($description) {
            case 'bad argument':
                $argument = $json['bad_argument'] ?? '';

                throw new BadArgumentException($argument);
                break;

            case 'Not Found':
                throw new EntitiesNotFound($request->uri());

                break;
        }
    }
}
