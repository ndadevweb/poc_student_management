<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\CheckResetToken;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;

#[ApiResource(
    shortName: 'CheckResetToken',
    operations: [
        new Get(
            uriTemplate: 'auth/password-reset/check-reset-token',
            input: CheckResetTokenInputDto::class,
            output: CheckResetTokenOutputDto::class,
            processor: CheckResetTokenStateProvider::class,
        )
    ],

)]
final class CheckResetTokenApi
{

}