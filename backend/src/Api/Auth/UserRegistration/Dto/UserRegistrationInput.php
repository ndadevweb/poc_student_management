<?php

namespace App\Api\Auth\UserRegistration\Dto;

use App\Repository\UserRepository;
use App\Validator\EmailExists\EmailExists as AssertCustomEmailExists;
use Symfony\Component\Validator\Constraints as Assert;

final class UserRegistrationInput
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstname;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastname;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[AssertCustomEmailExists(repository: UserRepository::class)]
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