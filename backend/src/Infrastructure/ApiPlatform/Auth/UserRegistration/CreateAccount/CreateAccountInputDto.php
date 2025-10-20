<?php

namespace App\Infrastructure\ApiPlatform\Auth\UserRegistration\CreateAccount;

use App\Infrastructure\Persistence\Doctrine\Repository\UserRepository;
use App\Infrastructure\Symfony\Validator\UniqueValue\UniqueValue as AssertUniqueValue;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateAccountInputDto
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstname;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastname;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[AssertUniqueValue(repository: UserRepository::class, field: 'email')]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\EqualTo(propertyPath: 'email')]
    public string $confirmEmail;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 255)]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'password')]
    public string $confirmPassword;
}