<?php

namespace App\Infrastructure\Adapter\Mail;

use App\Domain\Mail\MailSenderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SymfonyMailerAdapter implements MailSenderInterface
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly string $from
    ) {}

    public function send(string $to, string $subject, string $body, ?string $from = null): void
    {
        $sender = $from ?? $this->from;

        $email = (new Email())
            ->from(new Address($sender))
            ->to(new Address($to))
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}
