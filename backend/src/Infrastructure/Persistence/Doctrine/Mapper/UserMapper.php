<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Entity\User as DomainEntityUser;
use App\Infrastructure\Symfony\Entity\User as DoctrineEntityUser;

class UserMapper
{
    public static function toDoctrineEntity(DomainEntityUser $domainEntityUser): DoctrineEntityUser
    {
        $doctrineEntityUser = new DoctrineEntityUser;
        $doctrineEntityUser->setFirstname($domainEntityUser->getFirstname());
        $doctrineEntityUser->setLastname($domainEntityUser->getLastname());
        $doctrineEntityUser->setEmail($domainEntityUser->getEmail());
        $doctrineEntityUser->setPassword($domainEntityUser->getPassword());
        $doctrineEntityUser->setCreatedAt($domainEntityUser->getCreatedAt());

        return $doctrineEntityUser;
    }

    public static function toDomainEntity(DoctrineEntityUser $doctrineEntityUser): DomainEntityUser
    {
        return new DomainEntityUser(
            firstname: $doctrineEntityUser->getFirstname(),
            lastname: $doctrineEntityUser->getLastname(),
            email: $doctrineEntityUser->getEmail(),
            password: $doctrineEntityUser->getPassword(),
            createdAt: $doctrineEntityUser->getCreatedAt()
        );
    }
}