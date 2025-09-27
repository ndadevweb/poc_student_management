<?php

namespace App\Validator\EmailExists;

use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailExistsValidator extends ConstraintValidator
{
    public function __construct(private readonly ServiceLocator $locator) {}

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EmailExists) {
            throw new \LogicException(sprintf('%s can only validate %s constraints.', __CLASS__, EmailExists::class));
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

        if (!$repository instanceof EmailExistsRepositoryInterface) {
            throw new \InvalidArgumentException(sprintf(
                'Repository "%s" must implement %s',
                $constraint->repository,
                EmailExistsRepositoryInterface::class
            ));
        }

        if ($repository->emailExists((string) $value, $constraint->excludeUserId)) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ value }}', (string) $value)
                ->addViolation();
        }
    }
}
