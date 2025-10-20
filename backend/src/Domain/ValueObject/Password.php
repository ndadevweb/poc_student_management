<?php

namespace App\Domain\ValueObject;

final class Password
{
    public const MIN_LENGTH = 8;
    public const MAX_LENGTH = 255;

    public function __construct(private string $value)
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Password too short.');
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Password too long.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
