<?php

namespace App\Domain\Service;

interface PasswordResetTokenServiceInterface
{
    public function hasRequest(string $email): bool;

    public function generateToken(string $email): string;

    public function removeToken(string $email): void;

    public function isTokenExists(string $token): bool;

    public function countRequests(string $email): int;

    public function isRequestsReached(string $email): bool;

    public function resetCountRequests(string $email): void;
}
