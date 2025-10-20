<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\ChangePassword;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Auth\PasswordReset\ChangePassword\ChangePasswordCommand;
use App\Application\Auth\PasswordReset\ChangePassword\ChangePasswordCommandHandler;
use App\Infrastructure\Symfony\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ChangePasswordStateProcessor implements ProcessorInterface
{
    public function process(mixed $inputDto, Operation $operation, array $uriVariables = [], array $context = []): ChangePasswordOutputDto
    {
        /** @var ChangePasswordInputDto $inputDto */

        return new ChangePasswordOutputDto;
    }
}