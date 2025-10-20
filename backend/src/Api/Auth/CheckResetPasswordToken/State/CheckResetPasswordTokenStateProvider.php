<?php

namespace App\Api\Auth\CheckResetPasswordToken\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Api\Auth\CheckResetPasswordToken\Dto\CheckResetPasswordTokenOutput;
use App\Domain\Service\CheckResetPasswordTokenInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckResetPasswordTokenStateProvider implements ProviderInterface
{
    public function __construct(
        private CheckResetPasswordTokenInterface $checkResetPasswordTokenService
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): CheckResetPasswordTokenOutput
    {
        $token = $uriVariables['token'] ?? null;

        if ($this->checkResetPasswordTokenService->isTokenExist($token) === false) {
            throw new NotFoundHttpException('The reset token does not exist or has expired');
        }
       
        $this->checkResetPasswordTokenService->refreshValidity($token);

        return new CheckResetPasswordTokenOutput;
    }
}
