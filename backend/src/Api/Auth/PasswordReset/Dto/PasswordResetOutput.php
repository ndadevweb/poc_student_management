<?php

namespace App\Api\Auth\PasswordReset\Dto;

final class PasswordResetOutput
{
    public function __construct(
        public readonly string $message = "Password successfuly updated"
    ) {}
}