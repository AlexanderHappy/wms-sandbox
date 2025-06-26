<?php

namespace App\Repository;

use App\Dto\PropertiesDto;
use App\Entity\PropertyList;
use App\Interface\PropertiesInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PropertyList>
 */
class PropertyListRepository extends ServiceEntityRepository implements PropertiesInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct(
            $registry,
            PropertyList::class
        );
    }

    public function store(
        PropertiesDto $propertiesDto,
    ): bool
    {
        dd(
            $propertiesDto,
            __FILE__
        );
    }
}
