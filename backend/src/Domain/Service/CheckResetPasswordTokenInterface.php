<?php

namespace App\Domain\Service;

interface CheckResetPasswordTokenInterface
{
    public function isTokenExist(string $token): bool;

    public function refreshValidity(string $token): bool;
}