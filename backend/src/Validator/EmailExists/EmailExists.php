<?php

namespace App\Validator\EmailExists;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EmailExists extends Constraint
{
    public string $message = 'This email "{{ value }}" is already used.';

    /**
     * @param class-string<\App\Validator\EmailExistsRepositoryInterface> $repository
     */
    public function __construct(
        public string $repository, 
        public ?string $excludeUserId = null,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct([], $groups, $payload);
    }
}