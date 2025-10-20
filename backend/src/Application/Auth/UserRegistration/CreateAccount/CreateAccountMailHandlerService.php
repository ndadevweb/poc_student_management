<?php

namespace App\Application\Auth\UserRegistration\CreateAccount;

use App\Domain\Mail\MailHandlerServiceInterface;
use App\Domain\Mail\MailSenderInterface;
use App\Domain\Mail\MailTemplateRendererInterface;

final class CreateAccountMailHandlerService implements MailHandlerServiceInterface
{
    public function __construct(
        private MailTemplateRendererInterface $renderer,
        private MailSenderInterface $mailer,
        private string $frontCreateAccountConfirmationUrl
    ) {}

    public function send(string $to, ?array $options = []): void
    {
        $templatePath = 'mail/create-account';
        $subject = "Finalisation de la création de votre compte";
        $url = str_replace('{token}', $options['token'], $this->frontCreateAccountConfirmationUrl);
        $data = [
            'subject' => $subject,
            'url' => $url
        ];
        $body = $this->renderer->render($templatePath, $data);

        $this->mailer->send($to, $subject, $body);
    }
}
