<?php

namespace App\Api\Auth\ForgottenPassword\Dto;

final class ForgottenPasswordOutput
{
    public function __construct(
        public readonly string $message = "If an account associated with this email exists, a reset link will arrive in your inbox mail."
    ) {}
}