<?php

namespace ArtARTs36\HeadHunterApi\Exceptions;

class ExceptionHandler
{
    public function handle($message = null): void
    {
        if (is_string($message) && ($json = json_decode($message, true)) && ($desc = $json['description'])) {
            $this->byDescription($desc, $json);
        }

        throw new SendRequestException();
    }

    private function byDescription(string $description, array $json): void
    {
        switch ($description) {
            case 'bad argument':
                $argument = $json['bad_argument'] ?? '';

                throw new BadArgumentException($argument);
                break;
        }
    }
}
