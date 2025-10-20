<?php

namespace App\Application\Auth\PasswordReset\ForgottenPassword;

use App\Domain\Mail\MailHandlerServiceInterface;
use App\Domain\Mail\MailSenderInterface;
use App\Domain\Mail\MailTemplateRendererInterface;

final class ForgottenPasswordMailHandlerService implements MailHandlerServiceInterface
{
    public function __construct(
        private MailTemplateRendererInterface $renderer,
        private MailSenderInterface $mailer,
        private string $frontUrl
    ) {}

    public function send(string $to, ?array $options = []): void
    {
        $templatePath = 'mail/forgotten-password';
        $data = [
            'url_to_change_password' => $this->frontUrl
        ];
        $subject = "Demande de changement du mot de passe de votre compte";
        $body = $this->renderer->render($templatePath, $data);

        $this->mailer->send($to, $subject, $body);
    }
}