<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\ForgottenPassword;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    shortName: 'ForgottenPassword',
    operations: [
        new Post(
            uriTemplate: 'auth/password-reset/forgotten-password',
            input: ForgottenPasswordInputDto::class,
            output: ForgottenPasswordOutputDto::class,
            processor: ForgottenPasswordStateProcessor::class,
        )
    ],

)]
final class ForgottenPasswordApi {}
