<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function hasEmail(string $value): bool;

    public function register(User $user): void;
}