<?php

namespace App\Repository;

use App\Dto\PropertiesDto;
use App\Entity\Properties;
use App\Entity\PropertyType;
use App\Interface\PropertiesInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;


/**
 * @extends ServiceEntityRepository<Properties>
 */
class PropertiesRepository extends ServiceEntityRepository implements PropertiesInterface
{
    public function __construct(
        ManagerRegistry                  $registry,
        protected EntityManagerInterface $entityManagerInterface,
        protected LoggerInterface        $loggerInterface
    )
    {
        parent::__construct(
            $registry,
            Properties::class
        );
    }

    public function store(
        PropertiesDto $propertiesDto,
    ): bool
    {
        try {
            /** @var PropertyType $propertyType */
            $propertyType = $this->entityManagerInterface
                ->getRepository(PropertyType::class)
                ->find($propertiesDto->type);

            $properties = new Properties();
            $properties->setTitle($propertiesDto->title);
            $properties->setSlug($propertiesDto->slug);
            $properties->setTypeId($propertyType);

            $this->entityManagerInterface->persist($properties);
            $this->entityManagerInterface->flush();

            return true;
        } catch (\Exception $e) {
            $this->loggerInterface->error(
                'Failed to create properties',
                [
                    'error' => $e->getMessage(),
                    'dto'   => $propertiesDto,
                ]
            );

            return false;
        }
    }
}
