<?php

namespace App\DataFixtures;

use App\Entity\Properties;
use App\Entity\PropertyType;
use App\Factory\PropertiesFactory;
use App\Factory\PropertyTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager): void
    {
        PropertyTypeFactory::createMany(3);
        PropertiesFactory::createMany(25);
    }
}
