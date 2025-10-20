<?php

namespace App\Domain\Shared;

interface UniqueValueInterface
{
    public function isUniqueValue(string $field, string $value, ?string $excludeId): bool;
}