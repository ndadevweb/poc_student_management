<?php

namespace App\Api\Auth\PasswordReset\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Api\Auth\PasswordReset\Dto\PasswordResetOutput;

class PasswordResetStateProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): PasswordResetOutput
    {
        /** @var ResetPasswordInput $data */
//         print_r('password '.$data->password);
//         print_r('password confirm '.$data->passwordConfirmation);
// exit;

        return new PasswordResetOutput;
    }
}