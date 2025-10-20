<?php

namespace App\Infrastructure\Persistence\Redis;

use App\Domain\Cache\PasswordResetTokenCacheInterface;
use Psr\Cache\CacheItemInterface;

final class PasswordResetTokenCache implements PasswordResetTokenCacheInterface
{
    public function __construct(
        private CacheItemInterface $cache
    ) {}

    public function generate(): string
    {
        return '';
    }

    public function has(string $token): bool
    {
        return true;
    }

    public function remove(string $token): void
    {
        
    }
}