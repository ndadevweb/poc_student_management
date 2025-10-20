<?php

namespace App\Application\Auth\UserRegistration\CreateAccountConfirmation;

use App\Domain\Mail\MailHandlerServiceInterface;
use App\Domain\Repository\UserRepositoryInterface;

final class CreateAccountConfirmationCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private MailHandlerServiceInterface $mailHandler
    ) {}

    public function __invoke(CreateAccountConfirmationCommand $command): void
    {
        // $domainEntityUser = DomainEntityUser::register(
        //     $command->firstname,
        //     $command->lastname,
        //     $command->email,
        //     $command->password
        // );
// 
        $options = ['token' => 'A_REMPLACER_PAR_UNE_GENERATION_DE_TOKEN'];

        // $this->userRepository->register($domainEntityUser);
        // $this->mailHandler->send($command->email, $options);
    }
}