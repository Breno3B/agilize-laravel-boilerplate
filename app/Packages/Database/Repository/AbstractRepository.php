<?php

namespace App\Packages\Database\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class AbstractRepository
 * @package App\Packages\Database\Repository
 *
 * This class is a base class for all repositories.
 */
class AbstractRepository extends EntityRepository
{
    protected string $entityName;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata($this->entityName));
    }
}