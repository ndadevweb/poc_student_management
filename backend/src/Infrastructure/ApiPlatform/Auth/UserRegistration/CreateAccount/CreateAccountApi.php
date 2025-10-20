<?php

namespace App\Infrastructure\ApiPlatform\Auth\UserRegistration\CreateAccount;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    shortName: 'CreateAccount',
    operations: [
        new Post(
            uriTemplate: 'auth/create-account',
            input: CreateAccountInputDto::class,
            output: CreateAccountOutputDto::class,
            processor: CreateAccountStateProcessor::class,
        )
    ],

)]
final class CreateAccountApi {}
