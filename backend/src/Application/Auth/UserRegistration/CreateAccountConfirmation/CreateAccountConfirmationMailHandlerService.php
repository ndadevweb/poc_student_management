<?php

namespace App\Application\Auth\UserRegistration\CreateAccountConfirmation;

use App\Domain\Mail\MailSenderInterface;
use App\Domain\Mail\MailTemplateRendererInterface;

final class CreateAccountConfirmationCommandMailHandlerService
{
    public function __construct(
        private MailTemplateRendererInterface $renderer,
        private MailSenderInterface $mailer,
        private string $frontSigninUrl
    ) {}

    public function send(string $to, ?array $options = []): void
    {
        // $templatePath = 'mail/create-account';
        // $subject = "Votre inscription a bien été prise en compte";
        // $url = $this->frontSigninUrl;
        // $data = [
        //     'subject' => $subject,
        //     'url' => $url
        // ];
        // $body = $this->renderer->render($templatePath, $data);

        // $this->mailer->send($to, $subject, $body);
    }
}