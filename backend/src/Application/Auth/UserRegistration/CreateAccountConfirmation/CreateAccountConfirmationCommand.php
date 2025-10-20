<?php

namespace App\Application\Auth\UserRegistration\CreateAccountConfirmation;

final class CreateAccountConfirmationCommand
{
    public function __construct(
        public readonly string $token
    ) {}
}
