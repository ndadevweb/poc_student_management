<?php

namespace App\Validator\EmailExists;

interface EmailExistsRepositoryInterface
{
    public function emailExists(string $email, ?string $excludeUserId = null): bool;
}
