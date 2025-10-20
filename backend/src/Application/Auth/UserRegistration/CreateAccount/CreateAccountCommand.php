<?php

namespace App\Application\Auth\UserRegistration\CreateAccount;

final class CreateAccountCommand
{
    public function __construct(
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $email,
        public readonly string $password
    ) {}
}