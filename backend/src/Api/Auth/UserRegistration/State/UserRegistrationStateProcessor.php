<?php

namespace App\Api\Auth\UserRegistration\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Api\Auth\UserRegistration\Dto\UserRegistrationInput;
use App\Api\Auth\UserRegistration\Dto\UserRegistrationOutput;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly UserRepository $userRepository
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): UserRegistrationOutput
    {
        /** @var UserRegistrationInput $data */

        $user = new User;
        $password = $this->userPasswordHasher->hashPassword($user, $data->password);

        $user->setFirstname($data->firstname);
        $user->setLastname($data->lastname);
        $user->setEmail($data->email);
        $user->setPassword($password);
        $user->setCreatedAt(new DateTimeImmutable());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new UserRegistrationOutput;
    }
}
