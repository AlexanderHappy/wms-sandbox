<?php

namespace App\Service;

use App\Dto\PropertiesDto;
use App\Repository\Interface\PropertiesInterface;
use Symfony\Component\DependencyInjection\Attribute\Target;

class PropertyListService
{
    public function __construct(
        #[Target('properties.list.repository')]
        private PropertiesInterface $propertiesService,
    )
    {
    }

    public function store(
        PropertiesDto $propertiesDto,
    ): bool
    {
        $this->propertiesService->store($propertiesDto);
    }
}
