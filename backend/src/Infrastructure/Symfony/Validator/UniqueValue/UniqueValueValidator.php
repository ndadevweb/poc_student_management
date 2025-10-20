<?php

namespace App\Infrastructure\Symfony\Validator\UniqueValue;

use App\Domain\Shared\UniqueValueInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class UniqueValueValidator extends ConstraintValidator
{
    public function __construct(private readonly ServiceLocator $locator) {}

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueValue) {
            throw new \LogicException(sprintf('%s can only validate %s constraints.', __CLASS__, UniqueValue::class));
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!$this->locator->has($constraint->repository)) {
            throw new \InvalidArgumentException(sprintf(
                'Repository "%s" is not available in the locator.',
                $constraint->repository
            ));
        }

        $repository = $this->locator->get($constraint->repository);

        if (!$repository instanceof UniqueValueInterface) {
            throw new \InvalidArgumentException(sprintf(
                'Repository "%s" must implement %s',
                $constraint->repository,
                UniqueValueInterface::class
            ));
        }

        if ($repository->isUniqueValue($constraint->field, (string) $value, $constraint->excludeId) === false) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ field }}', $constraint->field)
                ->setParameter('{{ value }}', (string) $value)
                ->addViolation();
        }
    }
}
