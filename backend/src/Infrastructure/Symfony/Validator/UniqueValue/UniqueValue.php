<?php

namespace App\Infrastructure\Symfony\Validator\UniqueValue;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueValue extends Constraint
{
    public string $message = 'This value "{{ value }}" is already used.';

    /**
     * @param class-string<\App\Domain\Shared\UniqueValueInterface> $repository
     */
    public function __construct(
        public string $repository,
        public string $field,
        public ?string $excludeId = null,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct([], $groups, $payload);
    }
}
