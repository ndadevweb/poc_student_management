<?php

namespace App\Domain\Entity;

use DateTimeImmutable;

final class User
{
    public function __construct(
        private string $firstname,
        private string $lastname,
        private string $email,
        #[\SensitiveParameter]
        private string $password,
        private DateTimeImmutable $createdAt
    ) {}

    public static function register(
        string $firstname,
        string $lastname,
        string $email,
        #[\SensitiveParameter]
        string $password
    ): self {
        return new self(
            $firstname,
            $lastname,
            mb_strtolower($email),
            $password,
            new DateTimeImmutable()
        );
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
