<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\User as DomainEntityUser;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Shared\UniqueValueInterface;
use App\Infrastructure\Persistence\Doctrine\Mapper\UserMapper;
use App\Infrastructure\Symfony\Entity\User as DoctrineEntityUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
//extends ServiceEntityRepository 

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository implements UserRepositoryInterface, UniqueValueInterface, PasswordUpgraderInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function hasEmail(string $value): bool
    {
        return true;
        //     return $this->count(['email' => $value]) > 0;

        // $queryBuilder = $this->createQueryBuilder('u')
        //     ->select('COUNT(u.id)')
        //     ->where('u.email = :email')
        //     ->setParameter('email', $value);

        // return (int) $queryBuilder->getQuery()->getSingleScalarResult() > 0;
    }

    public function register(DomainEntityUser $domainEntityUser): void
    {
        $doctrineEntityUser = UserMapper::toDoctrineEntity($domainEntityUser);

        $this->entityManager->persist($doctrineEntityUser);
        $this->entityManager->flush();
    }

    public function isUniqueValue(string $field, string $value, ?string $excludeId): bool
    {
        $allowedFields = ['email'];
        if (in_array($field, $allowedFields, true) === false) {
            throw new \InvalidArgumentException(sprintf('Invalid field "%s".', $field));
        }

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('COUNT(u.id)')
            ->from(DoctrineEntityUser::class, 'u')
            ->where(sprintf('u.%s = :value', $field))
            ->setParameter('value', $value);

        if ($excludeId !== null) {
            $queryBuilder->andWhere('u.id != :excludeId')
                ->setParameter('excludeId', $excludeId);
        }

        return (int) $queryBuilder->getQuery()->getSingleScalarResult() === 0;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof DoctrineEntityUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function emailExists(string $email, ?string $excludeUserId = null): bool
    {
        return true;
        // $user = $this->findOneBy(['email' => $email]);

        // if ($user === null) {
        //     return false;
        // }

        // if ($excludeUserId !== null && (string) $user->getId() !== (string) $excludeUserId) {
        //     return false;
        // }

        // return true;
    }
}
