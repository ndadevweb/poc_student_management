<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

final class PasswordResetToken
{
    public const BYTES_LENGTH = 32;
    public const REGEX = '^[a-f0-9]{64}$';

    public function __construct(private string $token)
    {
        if (!preg_match('/'.self::REGEX.'/', $token)) {
            throw new InvalidArgumentException('Invalid token format');
        }
    }

    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(self::BYTES_LENGTH)));
    }

    public function value(): string
    {
        return $this->token;
    }
}