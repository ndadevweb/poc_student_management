<?php

namespace App\Domain\Mail;

interface MailHandlerServiceInterface
{
    public function send(string $to, ?array $options = []): void;
}