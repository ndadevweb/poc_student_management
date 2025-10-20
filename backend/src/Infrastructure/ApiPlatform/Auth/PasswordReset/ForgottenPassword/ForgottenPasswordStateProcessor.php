<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\ForgottenPassword;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Auth\PasswordReset\ChangePassword\ChangePasswordCommand;
use App\Application\Auth\PasswordReset\ChangePassword\ChangePasswordCommandHandler;
use App\Infrastructure\Symfony\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ForgottenPasswordStateProcessor implements ProcessorInterface
{
    public function process(mixed $inputDto, Operation $operation, array $uriVariables = [], array $context = []): ForgottenPasswordOutputDto
    {
        /** @var ChangePasswordInputDto $inputDto */

        return new ForgottenPasswordOutputDto;
    }
}