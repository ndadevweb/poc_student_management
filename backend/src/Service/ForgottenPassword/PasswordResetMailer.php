<?php

namespace App\Service\ForgottenPassword;

use App\Domain\Service\PasswordResetMailerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PasswordResetMailer implements PasswordResetMailerInterface
{
    public function __construct(
        private MailerInterface $mailer
    ) {}

    public function send(string $toEmail, string $token): void
    {
        // API URL ONLY USING FOR TEST
        $url = 'localhost:8880/api/auth/check-reset-password/'.$token;

        $content = $this->content($url);
        $mail = (new Email())
            ->from('no-reply@domain.local')
            ->to($toEmail)
            ->subject('Demande de réinitialisation de votre mot de passe')
            ->html($content);

        $this->mailer->send($mail);
    }

    private function content(string $url): string
    {
        return sprintf(
            "<p>Bonjour,</p>
            <p>Pour réinitialiser votre mot de passe, cliquez sur le lien ci-dessous:</p>
            <p><a href=\"%s\">%s</a></p>
            ", $url, $url
        );
    }
}
