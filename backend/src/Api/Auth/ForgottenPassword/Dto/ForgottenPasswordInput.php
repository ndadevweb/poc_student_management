<?php

namespace App\Api\Auth\ForgottenPassword\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class ForgottenPasswordInput
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}