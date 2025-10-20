<?php

namespace App\Domain\Mail;

interface MailTemplateRendererInterface
{
    public function render(string $templatePath, array $data = []): string;
}
