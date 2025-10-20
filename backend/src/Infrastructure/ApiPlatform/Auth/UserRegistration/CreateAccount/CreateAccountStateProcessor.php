<?php

namespace App\Infrastructure\ApiPlatform\Auth\UserRegistration\CreateAccount;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Auth\UserRegistration\CreateAccount\CreateAccountCommand;
use App\Application\Auth\UserRegistration\CreateAccount\CreateAccountCommandHandler;
use App\Infrastructure\Symfony\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAccountStateProcessor implements ProcessorInterface
{
    public function __construct(
        private CreateAccountCommandHandler $handler,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function process(mixed $inputDto, Operation $operation, array $uriVariables = [], array $context = []): CreateAccountOutputDto
    {
        /** @var CreateAccountInputDto $inputDto */

        $user = new User;
        $passwordHash = $this->userPasswordHasher->hashPassword($user, $inputDto->password);

        $command = new CreateAccountCommand(
            firstname: $inputDto->firstname,
            lastname: $inputDto->lastname,
            email: $inputDto->email,
            password: $passwordHash
        );

        ($this->handler)($command);

        return new CreateAccountOutputDto;
    }
}
