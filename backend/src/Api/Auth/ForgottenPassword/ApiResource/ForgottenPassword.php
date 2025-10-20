<?php

namespace App\Api\Auth\ForgottenPassword\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Api\Auth\ForgottenPassword\Dto\ForgottenPasswordInput;
use App\Api\Auth\ForgottenPassword\Dto\ForgottenPasswordOutput;
use App\Api\Auth\ForgottenPassword\State\ForgottenPasswordStateProcessor;

#[ApiResource(
    shortName: 'Forgotten Password',
    
    operations: [new Post(
        input: ForgottenPasswordInput::class,
        output: ForgottenPasswordOutput::class
    )],
    processor: ForgottenPasswordStateProcessor::class,
    uriTemplate: 'auth/forgotten-password'
)]
class ForgottenPassword
{
    
}