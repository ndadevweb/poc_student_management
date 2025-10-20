<?php

namespace App\Service\CheckResetPasswordToken;

use App\Domain\Service\CheckResetPasswordTokenInterface;
use Psr\Cache\CacheItemPoolInterface;

class CheckResetPasswordTokenService implements CheckResetPasswordTokenInterface
{
    public function __construct(
        private CacheItemPoolInterface $tokenCache,
    ) {}

    public function isTokenExist(string $token): bool
    {
        $item = $this->tokenCache->getItem($this->getTokenKey($token));

        return $item->isHit();
    }

    public function refreshValidity(string $token): bool
    {
        $key = $this->getTokenKey($token);
        $item = $this->tokenCache->getItem($key);

        return $this->tokenCache->save($item);
    }

    private function getTokenKey(string $token): string
    {
        return "reset_token_" . $token;
    }
}
