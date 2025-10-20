<?php

namespace App\Api\Auth\PasswordReset\Dto;

use App\Domain\ValueObject\Password;
use Symfony\Component\Validator\Constraints as Assert;

final class PasswordResetInput
{
    #[Assert\NotBlank]
    #[Assert\Length(min: Password::MIN_LENGTH, max: Password::MAX_LENGTH)]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'password')]
    public string $passwordConfirmation;
}