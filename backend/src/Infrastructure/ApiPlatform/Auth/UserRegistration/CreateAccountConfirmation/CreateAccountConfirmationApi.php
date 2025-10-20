<?php

namespace App\Infrastructure\ApiPlatform\Auth\UserRegistration\CreateAccountConfirmation;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    shortName: 'CreateAccountConfirmation',
    operations: [
        new Post(
            uriTemplate: 'auth/create-account/confirmation/{token}',
            input: CreateAccountConfirmationInputDto::class,
            output: CreateAccountConfirmationOutputDto::class,
            processor: CreateAccountConfirmationStateProcessor::class,
        )
    ],

)]
final class CreateAccountConfirmationApi {}
