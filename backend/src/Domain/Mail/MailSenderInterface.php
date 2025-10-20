<?php

namespace App\Domain\Mail;

interface MailSenderInterface
{
    public function send(string $to, string $subject, string $body, ?string $from = null): void;
}
