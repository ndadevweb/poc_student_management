<?php

namespace App\Api\Auth\CheckResetPasswordToken\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Api\Auth\CheckResetPasswordToken\Dto\CheckResetPasswordTokenOutput;
use App\Api\Auth\CheckResetPasswordToken\State\CheckResetPasswordTokenStateProvider;
use App\Domain\ValueObject\PasswordResetToken;

#[ApiResource(
    shortName: 'Check Reset Password Token',
    
    operations: [new Get(
        requirements: ['token' => PasswordResetToken::REGEX],
        output: CheckResetPasswordTokenOutput::class
    )],
    provider: CheckResetPasswordTokenStateProvider::class,
    uriTemplate: 'auth/check-reset-password/{token}'
)]
class CheckResetPasswordToken
{

}