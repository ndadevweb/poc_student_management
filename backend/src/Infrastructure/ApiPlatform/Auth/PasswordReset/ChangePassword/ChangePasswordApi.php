<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\ChangePassword;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    shortName: 'ChangePassword',
    operations: [
        new Post(
            uriTemplate: 'auth/password-reset/change-password',
            input: ChangePasswordInputDto::class,
            output: ChangePasswordOutputDto::class,
            processor: ChangePasswordStateProcessor::class,
        )
    ],

)]
final class ChangePasswordApi {}
