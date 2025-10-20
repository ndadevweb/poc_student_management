<?php

namespace App\Infrastructure\ApiPlatform\Auth\UserRegistration\CreateAccount;

final class CreateAccountOutputDto
{
    public function __construct(
        public readonly string $message = "Account created successfully"
    ) {}
}