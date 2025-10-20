<?php

namespace App\Infrastructure\Adapter\Mail;

use App\Domain\Mail\MailTemplateRendererInterface;
use Twig\Environment;

class TwigMailTemplateAdapter implements MailTemplateRendererInterface
{
    private const TEMPLATE_EXTENSION = '.html.twig';

    public function __construct(
        private readonly Environment $twig
    ) {}

    public function render(string $templatePath, array $data = []): string
    {
        $path = sprintf('%s%s', $templatePath, self::TEMPLATE_EXTENSION);

        return $this->twig->render($path, $data);
    }
}
