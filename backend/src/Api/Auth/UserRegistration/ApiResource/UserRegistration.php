<?php

namespace App\Api\Auth\UserRegistration\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Api\Auth\UserRegistration\Dto\UserRegistrationInput;
use App\Api\Auth\UserRegistration\Dto\UserRegistrationOutput;
use App\Api\Auth\UserRegistration\State\UserRegistrationStateProcessor;

#[ApiResource(
    shortName: 'UserRegistration',
    operations: [new Post(
        input: UserRegistrationInput::class,
        output: UserRegistrationOutput::class
    )],
    processor: UserRegistrationStateProcessor::class,
    uriTemplate: 'auth/registration'
)]
class UserRegistration
{
}