<?php

namespace App\Domain\Exception;

class TooManyPasswordResetRequestsException extends \RuntimeException
{
    public function __construct(string $email, int $maxRequests, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Too many password reset requests for %s (limit: %d/hour).', $email, $maxRequests),
            0,
            $previous
        );
    }
}
