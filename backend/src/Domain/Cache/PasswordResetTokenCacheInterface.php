<?php

namespace App\Domain\Cache;

interface PasswordResetTokenCacheInterface
{
    public function generate(): string;

    public function has(string $token): bool;

    public function remove(string $token): void;
}