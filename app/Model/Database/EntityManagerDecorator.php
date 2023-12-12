<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Repository\AbstractRepository;
use Doctrine\ORM\Decorator\EntityManagerDecorator as DoctrineEntityManagerDecorator;
use Doctrine\Persistence\ObjectRepository;

class EntityManagerDecorator extends DoctrineEntityManagerDecorator
{
    /**
     * @param string $entityName
     * @return AbstractRepository<T>|ObjectRepository<T>
     * @internal
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     * @phpstan-template T
     * @phpstan-param class-string<T> $entityName
     */
    public function getRepository($entityName): ObjectRepository
    {
        return parent::getRepository($entityName);
    }

}