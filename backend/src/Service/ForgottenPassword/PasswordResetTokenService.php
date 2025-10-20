<?php

namespace App\Service\ForgottenPassword;

use App\Domain\Exception\TooManyPasswordResetRequestsException;
use App\Domain\Service\PasswordResetTokenServiceInterface;
use App\Domain\ValueObject\PasswordResetToken;
use Psr\Cache\CacheItemPoolInterface;

class PasswordResetTokenService implements PasswordResetTokenServiceInterface
{
    public function __construct(
        private CacheItemPoolInterface $tokenCache,
        private CacheItemPoolInterface $countCache,
        private int $maxRequests,
        private int $counterTtl,
    ) {}

    public function hasRequest(string $email): bool
    {
        $key = $this->getTokenKey($email);
        $item = $this->tokenCache->getItem($key);

        return $item->isHit();
    }

    public function countRequests(string $email): int
    {
        $item = $this->countCache->getItem($this->getCountKey($email));

        return $item->isHit() ? (int) $item->get() : 0;
    }

    public function resetCountRequests(string $email): void
    {
        $this->countCache->deleteItem($this->getCountKey($email));
    }

    public function isRequestsReached(string $email): bool
    {
        return $this->countRequests($email) >= $this->maxRequests;
    }

    public function generateToken(string $email): string
    {
        if ($this->isRequestsReached($email)) {
            throw new TooManyPasswordResetRequestsException($email, $this->maxRequests);
        }

        $token = PasswordResetToken::generate()->value();
        // $token = bin2hex(random_bytes(32));
        $item = $this->tokenCache->getItem($this->getTokenKey($token));
        $item->set($email);

        $this->tokenCache->save($item);
        $this->incrementCountRequests($email);

        return $token;
    }

    public function removeToken(string $token): void
    {
        $this->tokenCache->deleteItem(
            $this->getTokenKey($token)
        );
    }

    private function incrementCountRequests(string $email): void
    {
        $key = $this->getCountKey($email);
        $item = $this->countCache->getItem($key);
        $count = $item->isHit() ? (int) $item->get() + 1 : 1;
        $item->set($count);
        $this->countCache->save($item);
    }

    public function isTokenExists(string $token): bool
    {
        $item = $this->tokenCache->getItem($this->getTokenKey($token));

        return $item->isHit();
    }

    private function getTokenKey(string $token): string
    {
        return "reset_token_" . $token;
    }

    private function getCountKey(string $email): string
    {
        return "reset_count_" . sha1($email);
    }
}
