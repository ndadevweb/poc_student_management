<?php

namespace App\Domain\Service;

interface PasswordResetMailerInterface
{
    public function send(string $toEmail, string $token): void;
}