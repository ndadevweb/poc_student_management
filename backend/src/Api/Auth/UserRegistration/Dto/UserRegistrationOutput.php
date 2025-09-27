<?php

namespace App\Api\Auth\UserRegistration\Dto;

final class UserRegistrationOutput
{
    public function __construct(
        public readonly string $message = "Account ceated successfully"
    ) {}
}