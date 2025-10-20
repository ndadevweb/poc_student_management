<?php

namespace App\Api\Auth\PasswordReset\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Api\Auth\PasswordReset\Dto\PasswordResetInput;
use App\Api\Auth\PasswordReset\Dto\PasswordResetOutput;
use App\Api\Auth\PasswordReset\State\PasswordResetStateProcessor;
use App\Domain\ValueObject\PasswordResetToken;

#[ApiResource(
    shortName: 'Password Reset',
    
    operations: [new Post(
        requirements: ['token' => PasswordResetToken::REGEX],
        input: PasswordResetInput::class,
        output: PasswordResetOutput::class
    )],
    processor: PasswordResetStateProcessor::class,
    uriTemplate: 'auth/reset-password/{token}'
)]
class PasswordReset
{

}