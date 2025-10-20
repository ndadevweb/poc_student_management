<?php

namespace App\Infrastructure\ApiPlatform\Auth\PasswordReset\CheckResetToken;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

final class CheckResetTokenStateProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        

        return null;
    }
}