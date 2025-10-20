<?php

namespace App\Api\Auth\ForgottenPassword\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Api\Auth\ForgottenPassword\Dto\ForgottenPasswordInput;
use App\Api\Auth\ForgottenPassword\Dto\ForgottenPasswordOutput;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Service\PasswordResetMailerInterface;
use App\Domain\Service\PasswordResetTokenServiceInterface;

class ForgottenPasswordStateProcessor implements ProcessorInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordResetTokenServiceInterface $passwordResetTokenService,
        private PasswordResetMailerInterface $passwordResetMailer
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ForgottenPasswordOutput
    {
        /** @var ForgottenPasswordInput $data */

        if ($this->userRepository->hasEmail($data->email) === false) {
            return new ForgottenPasswordOutput;
        }

        $token = $this->passwordResetTokenService->generateToken($data->email);
        $this->passwordResetMailer->send($data->email, $token);

        return new ForgottenPasswordOutput;
    }
}