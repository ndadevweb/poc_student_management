<?php

namespace App\Api\Auth\CheckResetPasswordToken\Dto;

final class CheckResetPasswordTokenOutput
{
    public function __construct(
        public readonly string $message = 'The password can be modified'
    ) {}
}